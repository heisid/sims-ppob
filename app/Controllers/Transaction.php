<?php

namespace App\Controllers;

use App\Libraries\ApiClient;
use DateTime;
use DateTimeZone;
use PHPUnit\Exception;

class Transaction extends BaseController
{
    protected $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient();
    }

    public function index()
    {
        $response = $this->apiClient->getTransactions();
        if ($response['success']) {
            $transactions = $response['data']['data']['records'];
            $this->convertTransactionsDate($transactions);
            $data['transactions'] = $transactions;
        } else $data['transactions'] = [];

        return view('transaction/index', $data);
    }

    private function convertTransactionsDate(&$transactions)
    {
        foreach ($transactions as &$transaction) {
            try {
                $date = new DateTime($transaction['created_on'], new DateTimeZone("UTC"));
                $date->setTimezone(new DateTimeZone("Asia/Jakarta"));
                $transaction['created_on'] = $date->format("d F Y · H:i") . " WIB";
            } catch (\Exception $e) {}
        }
        return $transactions;
    }

    public function getTransactionsWithOffset($offset)
    {
        $response = $this->apiClient->getTransactions($offset);
        if ($response['success']) {
            $transactions = $response['data']['data']['records'];
            $this->convertTransactionsDate($transactions);
            return $this->response->setJSON($transactions);
        }
        return $this->response->setStatusCode($response['http_code'])->setJSON([]);
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

        return view('transaction/pay', $data);
    }

    public function doPay()
    {
        $json = $this->request->getJSON(true);

        $serviceCode = $json['service_code'] ?? null;

        $paymentResponse = $this->apiClient->pay($serviceCode);
        if ($paymentResponse['success']) {
            $balanceResponse = $this->apiClient->getBalance();
            if ($balanceResponse['success']) session()->set(['balance' => $balanceResponse['data']['data']['balance']]);
            return $this->response->setJSON(['message' => $paymentResponse['data']['message']]);

        }
        return $this->response->setStatusCode($paymentResponse['http_code']);
    }

    public function topup()
    {
        return view('transaction/topup');
    }

    public function doTopup()
    {
        $json = $this->request->getJSON(true);
        $amount = $json['top_up_amount'] ?? 0;
        if (is_null($amount)) return $this->response->setStatusCode(400)->setJSON([]);

        $response = $this->apiClient->topUp($amount);
        if ($response['success']) {
            $balanceResponse = $this->apiClient->getBalance();
            if ($balanceResponse['success']) session()->set(['balance' => $balanceResponse['data']['data']['balance']]);
            return $this->response->setJSON(['message' => $response['data']['message']]);
        }
        return $this->response->setStatusCode($response['http_code']);
    }
}