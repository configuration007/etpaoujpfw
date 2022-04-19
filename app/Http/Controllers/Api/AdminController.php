<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\Wallet;
use App\Models\ClientPlan;
use App\Models\AdminWallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ClientNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{
    public function sendNotification(Request $request)
    {
        $notification = new ClientNotification();
        $notification->user_id = $request->client_id;
        $notification->content = $request->content;
        $notification->subject = $request->subject;
        $notification->save();

        $user =  User::find($request->client_id);
        if ($request->send_to_mail) {

            try {
                Mail::send(
                    'emails.notification',
                    [
                        'user' => $user,
                        'content' => $request->content,
                        'url'=>'/login'
                    ],
                    function ($message) use ($user, $request) {
                        $message->to($user->email)
                            ->subject(config( $request->subject));
                        $message->from(config('mail.mail_subject_email'));
                    }
                );
            } catch (Exception $e) {
    
                return $this->successResponse(400, null, $e->getMessage());
            }
        }
        return $this->successResponse(200, $notification, 'Notification Sent');
    }



    public function updateWithdrawalPlan(Request $request)
    {
        $client = ClientPlan::firstOrNew(
            ['user_id' => $request->client_id]
        );
        $client->user_id = $request->client_id;
        $client->admin_wallet_id = $request->admin_wallet_id;
        $client->allow_withdrawal = $request->allow_withdrawal;
        $client->withdrawal_message = $request->withdrawal_message;
        $client->save();
        return $this->successResponse(200, $client, 'Clients');
    }

    public function getDestWallets()
    {
        $wallets = AdminWallet::get();
        return $this->successResponse(200, $wallets, 'Clients');
    }
    public function createDestWallets(Request $request)
    {
        $wallet = new AdminWallet;
        $wallet->name = $request->name;
        $wallet->address = $request->address;
        $wallet->barcode = $request->barcode;
        $wallet->save();

        return $this->successResponse(200, $wallet, 'Wallet Deleted');
    }

    public function updateDestWallets(Request $request, $id)
    {
        $wallet =  AdminWallet::find($id);
        $wallet->name = $request->name;
        $wallet->address = $request->address;
        $wallet->barcode = $request->barcode;
        $wallet->save();

        return $this->successResponse(200, $wallet, 'Wallet Updated');
    }

    public function deleteDestWallets(Request $request, $id)
    {
        $wallet =  AdminWallet::find($id);
        $wallet->delete();

        return $this->successResponse(200, null, 'Wallet Deleted');
    }

    public function clients()
    {
        $users = User::where('is_admin', false)->with('wallet')->with('plan')->get();
        return $this->successResponse(200, $users, 'Clients');
    }
    public function transaction(Request $request)
    {
        $transaction  = new Transaction();
        $transaction->address = $request->address;
        $transaction->fiat = $request->fiat;
        $transaction->amount = $request->amount;
        $transaction->description = $request->description;
        $transaction->user_id = $request->client_id;
        $transaction->status = $request->status;
        $transaction->type = $request->type;
        $transaction->save();

        if ($request->should_top_up) {
            Wallet::credit($request->wallet_id, $request->amount);
        }

        return $this->successResponse(200, $transaction, 'Clients Transaction');
    }
    public function unitTransaction($fiat)
    {
        $transaction  =  Transaction::where('fiat', $fiat)->get();

        return $this->successResponse(200, $transaction, 'Clients Unit Transaction');
    }
    public function topUp(Request $request)
    {
        $topup = Wallet::credit($request->wallet_id, $request->amount);
        return $this->successResponse(200, $topup, 'Clients Top up');
    }
}
