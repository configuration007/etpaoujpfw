<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Log;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\HelpersTrait;

class ClientController extends BaseController
{
    use HelpersTrait;
    public function getBackupPhrase()
    {
        $user  = auth('api')->user();
        $phrase = User::find($user->id);
        $this->log($user->id , 'Obtained backup phrase');
        return $this->successResponse(200, $phrase, 'Backup phrase');
    }

    public function getBarcode()
    {
        $user  = auth('api')->user();
        $plan = User::find($user->id)->plan;

        $data = $plan ? $plan->barcode : '';
        $this->log($user->id , 'Obtained barcode');

        return $this->successResponse(200, $data, 'Transction processed');
    }
    public function initiateTransaction(Request $request)
    {
        $user  = auth('api')->user();
        $plan = User::find($user->id)->plan;

        $transaction  = new Transaction();
        $transaction->address = $request->address;
        $transaction->fiat = $request->fiat;
        // $transaction->fiat_amount = $request->fiat_amount;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->user_id = $user->id;
        $transaction->status = $plan->allow_withdrawal ? 'proccessing' : 'failed';
        $transaction->type = 'Send';
        $transaction->save();
        $this->log($user->id , 'Initiated a transaction');

        $data = $plan->withdrawal_message;

        if ($plan->allow_withdrawal) {
            Wallet::debit($user->wallet_id, $request->amount);
            $data = 'isSuccessfull';
        }

        return $this->successResponse(200, $data, 'Transction processed');
    }

    public function getRate($currency)
    {
        $response =  file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=' . $currency . '&ids=bitcoin');

        $response = json_decode($response, true);
        return $response[0]['current_price'];
    }
    public function getRates()
    {
        try {
            $response['usd'] = $this->getRate('usd');
            $response['gbp'] =  $this->getRate('gbp');
            $response['eur'] =  $this->getRate('eur');

            return $this->successResponse(200, $response, 'List Of currencies');
        } catch (Exception $e) {

            return $this->successResponse(400, $e->getMessage(), 'List Of currencies');
        }
    }

    public function transactions()
    {
        $me = auth('api')->user();
        $transaction  =  Transaction::where('user_id',  $me->id)->get();
        $this->log($me->id , 'Viewed transactions');

        return $this->successResponse(200, $transaction, 'Clients Unit Transaction');
    }


    public function getLogs()
    {
        $user = auth('api')->user();
        $logs  =  Log::where('user_id',  $user->id)->get();
        $this->log($user->id , 'Viewed Logs');

        return $this->successResponse(200, $logs, 'Logs');
    }

    public function unitTransaction($fiat)
    {
        $user = auth('api')->user();
        $transaction  =  Transaction::where('fiat', $fiat)->get();
        $this->log($user->id , 'Viewed transactions');

        return $this->successResponse(200, $transaction, 'Clients Unit Transaction');
    }
}
