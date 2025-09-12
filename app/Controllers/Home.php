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

        $servicesResponse = $apiClient->getServices();
        $data['services'] = $servicesResponse['data']['data'] ?? array();

        $bannersResponse = $apiClient->getBanners();
        $data['banners'] = $bannersResponse['data']['data'] ?? array();

        return view('home/dashboard', $data);
    }
}