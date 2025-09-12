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
}