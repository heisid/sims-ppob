<?php

namespace App\Controllers;

use App\Libraries\ApiClient;

class Transaction extends BaseController
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
    }

    public function index()
    {
        $page = $this->request->getGet('page') ?? 1;
        $response = $this->apiClient->getTransactions($page);

        $data = [
            'transactions' => $response['success'] ? $response['data'] : []
        ];

        return view('transaction/index', $data);
    }

    public function detail($id)
    {
        $response = $this->apiClient->getTransactionDetail($id);

        $data = [
            'transaction' => $response['success'] ? $response['data'] : null
        ];

        return view('transaction/detail', $data);
    }

    public function pay($code)
    {
        $servicesResponse = $this->apiClient->getServices();
        $services = $servicesResponse['data']['data'];
        $data = array();
        foreach ($services as $serviceItem) {
            if ($serviceItem['service_code'] == $code) {
                $data['service'] = $serviceItem;
                break;
            }
        }

        if (count($data) == 0) return redirect('/dashboard')->with('errors', 'Kode pembayaran tidak valid');

        $profileResponse = $this->apiClient->getProfile();
        $profile = $profileResponse['data']['data'] ?? array();
        $data['first_name'] = $profile['first_name'];
        $data['last_name'] = $profile['last_name'];

        $balanceResponse = $this->apiClient->getBalance();
        $data['balance'] = $balanceResponse['data']['data']['balance'] ?? 0;

        return view('transaction/pay', $data);
    }

    public function doPay()
    {
        $json = $this->request->getJSON(true);

        $serviceCode = $json['service_code'] ?? null;

        $paymentResponnse = $this->apiClient->pay($serviceCode);
        return $this->response->setJSON($paymentResponnse);
    }
}