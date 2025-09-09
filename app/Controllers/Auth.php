<?php

namespace App\Controllers;

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
        if (session()->get('jwt_token')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function doLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $response = $this->apiClient->login($email, $password);

        if ($response['success']) {
            $data = $response['data'];

            session()->set([
                'jwt_token' => $data['token'],
                'user_data' => $data['user'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard')->with('success', 'Login successful');
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
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'password_confirmation' => $this->request->getPost('password_confirmation')
        ];

        $response = $this->apiClient->register($data);

        if ($response['success']) {
            return redirect()->to('/auth/login')
                ->with('success', 'Registration successful. Please login.');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Registration failed');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Logged out successfully');
    }
}
