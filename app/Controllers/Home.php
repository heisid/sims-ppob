<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('token')) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/auth/login');
    }

    public function dashboard()
    {
        $apiClient = new \App\Libraries\ApiClient();
        $profileResponse = $apiClient->getProfile();

        $data = $profileResponse['data']['data'] ?? array();

        $balanceResponse = $apiClient->getBalance();
        $data['balance'] = $balanceResponse['data']['data']['balance'] ?? 0;

        return view('home/dashboard', $data);
    }
}