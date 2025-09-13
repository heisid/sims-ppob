<?php

namespace App\Controllers;

use App\Helpers\Helper;
use App\Libraries\ApiClient;

class Auth extends BaseController
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
    }

    public function login()
    {
        if (session()->get('token')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $response = $this->apiClient->login($email, $password);

        $data = $response['data'];
        if ($data['status'] == 0) {
            $payload = $data['data'];

            session()->set([
                'token' => $payload['token'],
                'logged_in' => true,
            ]);

            $profileResponse = $this->apiClient->getProfile();
            $profile = $profileResponse['data']['data'] ?? array();

            $balanceResponse = $this->apiClient->getBalance();
            $balance = $balanceResponse['data']['data']['balance'] ?? 0;

            session()->set([
                'profile' => $profile,
                'balance' => $balance,
            ]);


            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Login failed');
        }
    }

    public function register()
    {
        if (session()->get('jwt_token')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    public function doRegister()
    {
        $data = [
            'first_name' => $this->request->getPost('first_name'),
            'last_name' => $this->request->getPost('last_name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ];


        $response = $this->apiClient->register($data);

        if ($response['success']) {
            return redirect()->to('/auth/login')
                ->with('success', 'Registrasi berhasil. Silahkan login');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Registrasi gagal');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
