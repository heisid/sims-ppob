<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class ImageProxy extends BaseController
{
    private $cacheDir;
    private $cacheExpiry = 3600;
    private $storageBaseUrl;

    public function __construct()
    {
        $this->cacheDir = WRITEPATH . 'cache/images/';

        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
        $this->storageBaseUrl = env('IMAGE_PROXY_BASE_URL', 'https://minio.nutech-integrasi.com/take-home-test');
    }

    public function proxy()
    {
        $uri = service('uri');
        $segments = array_slice($uri->getSegments(), 1);
        $imagePath = '/'.implode('/', $segments);
        if ($imagePath == '/') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $cacheFile = $this->cacheDir . md5($imagePath) . '.cache';
        $metaFile = $cacheFile . '.meta';

        if ($this->isCacheValid($cacheFile, $metaFile)) {
            return $this->serveCachedImage($cacheFile, $metaFile);
        }

        $apiUrl = $this->storageBaseUrl.$imagePath;

        try {
            $client = \Config\Services::curlrequest();

            $response = $client->get($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . session()->get('token'),
                    'User-Agent' => 'CodeIgniter-ImageProxy'
                ],
                'timeout' => 30
            ]);

            if ($response->getStatusCode() !== 200) {
                return $this->response->setStatusCode(404)->setBody('Image not found');
            }

            $imageData = $response->getBody();
            $contentType = $response->getHeader('Content-Type');
            $contentLength = strlen($imageData);

            file_put_contents($cacheFile, $imageData);

            $metadata = [
                'content_type' => $contentType,
                'content_length' => $contentLength,
                'cached_at' => time(),
                'original_url' => $apiUrl
            ];
            file_put_contents($metaFile, json_encode($metadata));

            return $this->serveImage($imageData, $contentType, $contentLength);

        } catch (\Exception $e) {
            log_message('error', 'Image proxy error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setBody('Error fetching image');
        }
    }

    private function isCacheValid($cacheFile, $metaFile)
    {
        if (!file_exists($cacheFile) || !file_exists($metaFile)) {
            return false;
        }

        $metadata = json_decode(file_get_contents($metaFile), true);

        return (time() - $metadata['cached_at']) < $this->cacheExpiry;
    }

    private function serveCachedImage($cacheFile, $metaFile)
    {
        $imageData = file_get_contents($cacheFile);
        $metadata = json_decode(file_get_contents($metaFile), true);

        return $this->serveImage(
            $imageData,
            $metadata['content_type'],
            $metadata['content_length']
        );
    }

    private function serveImage($imageData, $contentType, $contentLength)
    {
        $this->response->setHeader('Content-Type', $contentType);
        $this->response->setHeader('Content-Length', $contentLength);
        $this->response->setHeader('Cache-Control', 'public, max-age=' . $this->cacheExpiry);
        $this->response->setHeader('Expires', gmdate('D, d M Y H:i:s', time() + $this->cacheExpiry) . ' GMT');

        $etag = md5($imageData);
        $this->response->setHeader('ETag', '"' . $etag . '"');

        if ($this->request->getHeaderLine('If-None-Match') === '"' . $etag . '"') {
            return $this->response->setStatusCode(304);
        }

        return $this->response->setBody($imageData);
    }

    public function clearCache()
    {
        $files = glob($this->cacheDir . '*');
        $deletedCount = 0;

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
                $deletedCount++;
            }
        }

        return $this->response->setJSON([
            'message' => 'Cache cleared successfully',
            'files_deleted' => $deletedCount
        ]);
    }
}