<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Profile extends BaseController
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
    }

    public function index()
    {
        $data = session()->get('profile');

        return view('profile/view', $data);
    }

    public function update()
    {
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
        ];

        $response = $this->apiClient->updateProfile($data);

        if ($response['success']) {
            $newProfile = $response['data']['data'];
            session()->set('profile', $newProfile);

            return $this->response->setJSON($newProfile);
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Update failed');
        }
    }

    public function updateImage()
    {
        $file = $this->request->getFile('profile_image');
        if (!$file->isValid()) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['message' => 'Invalid uploaded file']);
        }

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!in_array($file->getMimeType(), $allowedTypes)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['message' => 'Invalid file type. Only JPEG, PNG are allowed.']);
        }

        if ($file->getSize() > env('MAX_FILE_SIZE_IN_KB', 100) * 1024) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON(['message' => 'Maximum file size allowed is 100 kb.']);
        }

        $response = $this->apiClient->updateImage($file);
        if ($response['success']) {
            session()->set('profile', $response['data']['data']);
            return $this->response->setJSON($response['data']['data']);
        }
        return $this->response->setStatusCode($response['http_code']);
    }
}