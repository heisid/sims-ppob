<?php

namespace App\Libraries;

class ApiClient
{
    private $baseUrl;
    private $timeout;
    private $session;

    public function __construct()
    {
        $this->baseUrl = env('API_BASE_URL', 'https://take-home-test-api.nutech-integrasi.com');
        $this->timeout = 30;
        $this->session = session();
    }

    private function makeRequest($method, $endpoint, $data = [], $requireAuth = false, $isFileUpload = false)
    {
        $curl = curl_init();

        $headers = [
            'Accept: application/json',
        ];

        if (!$isFileUpload) {
            $headers[] = 'Content-Type: application/json';
        }

        if ($requireAuth && $this->session->get('token')) {
            $headers[] = 'Authorization: Bearer ' . $this->session->get('token');
        }

        $options = [
            CURLOPT_URL => $this->baseUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => false,
        ];

        switch (strtoupper($method)) {
            case 'POST':
                $options[CURLOPT_POST] = true;
                if ($isFileUpload) {
                    $options[CURLOPT_POSTFIELDS] = $data;
                } else {
                    $options[CURLOPT_POSTFIELDS] = json_encode($data);
                }
                break;
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                if ($isFileUpload) {
                    $options[CURLOPT_POSTFIELDS] = $data;
                } else {
                    $options[CURLOPT_POSTFIELDS] = json_encode($data);
                }
                break;
            case 'DELETE':
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                break;
        }

        curl_setopt_array($curl, $options);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return ['success' => false, 'message' => 'Connection error: ' . $error];
        }

        $decoded = json_decode($response, true);

        return [
            'success' => $httpCode >= 200 && $httpCode < 300,
            'data' => $decoded,
            'http_code' => $httpCode
        ];
    }

    public function login($email, $password)
    {
        return $this->makeRequest('POST', '/login', [
            'email' => $email,
            'password' => $password
        ]);
    }

    public function register($data)
    {
        return $this->makeRequest('POST', '/registration', $data);
    }

    public function getProfile()
    {
        return $this->makeRequest('GET', '/profile', [], true);
    }

    public function getBalance()
    {
        return $this->makeRequest('GET', '/balance', [], true);
    }

    public function getServices()
    {
        return $this->makeRequest('GET', '/services', [], true);
    }

    public function getBanners()
    {
        return $this->makeRequest('GET', '/banner', [], true);
    }

    public function updateProfile($data)
    {
        return $this->makeRequest('PUT', '/profile/update', $data, true);
    }


    public function updateImage($uploadedFile)
    {
        $tempPath = $uploadedFile->getTempName();

        $curlFile = new \CURLFile(
            $tempPath,
            $uploadedFile->getMimeType(),
            $uploadedFile->getClientName()
        );

        $data = ['file' => $curlFile];

        return $this->makeRequest('PUT', '/profile/image', $data, true, true);
    }

    public function topUp($amount)
    {
        return $this->makeRequest('POST', '/topup', ['top_up_amount' => $amount], true);
    }

    public function pay($serviceCode)
    {
        return $this->makeRequest('POST', '/transaction', ['service_code' => $serviceCode], true);
    }

    public function getTransactions($offset = 0, $limit = 5)
    {
        return $this->makeRequest('GET', "/transaction/history?offset={$offset}&limit={$limit}", [], true);
    }
}