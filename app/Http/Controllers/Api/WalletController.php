<?php

namespace App\Http\Controllers\Api;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
 public function getBalance($fiat, $balance, $currency)
    {
        $data =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=' . $fiat . '&ids=' . $currency), true)[0]['current_price'];
        return number_format($data ? $balance * $data : $balance, 2);
    }

    public function walletBalance($currency)
    {
        $balance = auth('api')->user()->wallet[$currency];
    
        $data['fiat_balances']  = [
            'usd' => $balance ? $this->getBalance('usd', $balance, $currency) : 0.00,
            'gbp' => $balance ? $this->getBalance('gbp', $balance, $currency) : 0.00,
            'eur' => $balance ? $this->getBalance('eur', $balance, $currency) : 0.00,
            'jpy' => $balance ? $this->getBalance('jpy', $balance, $currency) : 0.00,
            'btc' => $balance
        ];

        $data['crypto_balance']  = $balance;
        return $data;
    }

}
