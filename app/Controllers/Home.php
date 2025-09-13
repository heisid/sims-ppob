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
        foreach ($services as &$service) {
            $service['service_icon'] = base_url('/proxy-image').Helper::extractPath($service['service_icon']);
        }
        $data['services'] = $services;

        $bannersResponse = $apiClient->getBanners();
        $banners = $bannersResponse['data']['data'] ?? array();
        foreach ($banners as &$banner) {
            $banner['banner_image'] = base_url('/proxy-image').Helper::extractPath($banner['banner_image']);
        }
        $data['banners'] = $banners;

        return view('home/dashboard', $data);
    }
}