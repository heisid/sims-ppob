<?php

namespace App\Controllers;

use App\Helpers\Helper;

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
        $services = $servicesResponse['data']['data'] ?? array();

        $data['services'] = $services;

        $bannersResponse = $apiClient->getBanners();
        $banners = $bannersResponse['data']['data'] ?? array();

        $data['banners'] = $banners;

        return view('home/dashboard', $data);
    }
}