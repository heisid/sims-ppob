<?php

namespace App\Helpers;

class Helper
{
    public static function extractPath($originalUrl)
    {
        $storageBaseUrl = env('IMAGE_PROXY_BASE_URL', 'https://minio.nutech-integrasi.com/take-home-test');
        return str_replace($storageBaseUrl, '', $originalUrl);
    }
}