<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class StackController extends BaseController
{
    public function price($crypto_currency, $fiat_currency)
    {
        try {
            $data =  file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=' . $fiat_currency . '&ids=' . $crypto_currency);
            $data = json_decode($data, true);
            $data = $data[0]['current_price'];
            $data = number_format($data);
            return $data;
        } catch (Exception $e) {
            return 0.00;
        }
    }
    public function getPrice($crypto_currency, $fiat_currency = null)
    {

        $currency = $fiat_currency ?? 'usd';
        $validator = Validator::make(['currency' => $crypto_currency, 'fiat' => $currency], [
            'currency' => 'required|in:bitcoin,ethereum,ripple,tether,stellar,algorand,litecoin,monero',
            'fiat' => 'sometimes|in:usd,eur,gbp,jpy'

        ]);

        if ($validator->fails()) {
            return response($validator->messages(), 422);
        }

        $data = $this->price($crypto_currency, $currency);
        return $this->successResponse(200, $data, 'User Created Succesffuly');
    }

    public function getPrices()
    {
        $currencies  = ['bitcoin', 'ethereum', 'ripple', 'stellar'];
        $data = [];

        try {
            $response =  file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');
            $response = json_decode($response, true);
     
            $da = [];

            foreach ($response as $d) {
                $da[$d['id']] = $d;
            }

            foreach ($currencies as $currency) {
                $data[$currency] = null ;
                $data[$currency]['amount'] = number_format($da[$currency]['current_price'],2);
                $data[$currency]['rate'] =  number_format($da[$currency]['price_change_percentage_24h'],2);
            }
            return $this->successResponse(200, $data, 'List Of currencies');
        } catch (Exception $e) {
            return 0.00;
        }
    }
    public function getPricesStat()
    {
        $currencies  = ['bitcoin', 'ethereum', 'ripple'];
        $data = [];

        try {
            $response =  file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd');
            $response = json_decode($response, true);
      
            $da = [];
            foreach ($response as $d) {
                $da[$d['id']] = $d;
            }

            foreach ($currencies as $currency) {
                $data[$currency] = null ;
                $data[$currency]['amount'] = number_format($da[$currency]['current_price'],2);
                $data[$currency]['rate'] =  number_format($da[$currency]['price_change_percentage_24h'],2);
                $data[$currency]['extra'] =  number_format($da[$currency]['ath_change_percentage'],2);
                $data[$currency]['image'] =  $da[$currency]['image'];
                $data[$currency]['symbol'] =  $da[$currency]['symbol'];
            }
            return $this->successResponse(200, $data, 'List Of currencies');
        } catch (Exception $e) {
            return 0.00;
        }
    }
}
