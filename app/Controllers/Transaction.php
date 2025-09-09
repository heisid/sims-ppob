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
}