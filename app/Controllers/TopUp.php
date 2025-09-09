<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class TopUp extends BaseController
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
    }

    public function index()
    {
        return view('topup/index');
    }

    public function process()
    {
        $amount = $this->request->getPost('amount');

        $response = $this->apiClient->topUp($amount);

        if ($response['success']) {
            return redirect()->to('/topup')
                ->with('success', 'Top up successful');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', $response['data']['message'] ?? 'Top up failed');
        }
    }
}