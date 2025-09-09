<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('jwt_token')) {
            return redirect()->to('/dashboard');
        }

        return view('home/index');
    }

    public function dashboard()
    {
        $apiClient = new \App\Libraries\ApiClient();
        $profileResponse = $apiClient->getProfile();

        $data = [
            'user' => $profileResponse['success'] ? $profileResponse['data'] : null
        ];

        return view('home/dashboard', $data);
    }
}