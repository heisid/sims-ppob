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
        $profileResponse = $this->apiClient->getProfile();

        $data = $profileResponse['data']['data'] ?? array();

        return view('profile/view', $data);
    }

    public function edit()
    {
        $response = $this->apiClient->getProfile();

        $data = [
            'profile' => $response['success'] ? $response['data'] : null
        ];

        return view('profile/edit', $data);
    }

    public function update()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = $this->request->getPost('password');
            $data['password_confirmation'] = $this->request->getPost('password_confirmation');
        }

        $response = $this->apiClient->updateProfile($data);

        if ($response['success']) {
            session()->set('user_data', $response['data']);

            return redirect()->to('/profile')
                ->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Update failed');
        }
    }
}