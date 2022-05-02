<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Carbon\Carbon;
use Faker\Factory;
use App\Models\User;
use App\Models\Wallet;
use App\Models\ClientPlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use App\Http\Controllers\Api\HelpersTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\WalletController;

class RegistrationController extends BaseController
{
    use HelpersTrait;
    public function seedAmin()
    {
        $user = User::where('email', 'superadmin@super.com')->first();
        if ($user) {
            $user->name = 'blockchain';
            $user->email = 'superadmin@super.com';
            $user->password = bcrypt('superadmin@super.com');
            $user->is_admin = true;
            $user->save();
            return 'New OK';
        } else {
            $user = new User();
            $user->name = 'blockchain';
            $user->email = 'superadmin@super.com';
            $user->password = bcrypt('superadmin@super.com');
            $user->is_admin = true;
            $user->save();
            return 'OK';
        }
    }

    public function generateBackUpPhrase()
    {
        $words = $this->words();
        $text = '';
        $i = 0;
        while ($i < 12) {

            $w = $words[rand(0, 2466)];
            $text = $text . $w;
            if ($i != 11) {
                $text = $text . '|';
            }

            $i++;
        }
        return $text;
    }

    public function generateWalletNumber()
    {

        $wallet_length = 36;
        $start = 1;
        $wallet = '';

        while ($wallet_length >= $start) {
            $char = rand(0, 6);
            if (in_array($start, [9, 14, 19, 24])) {
                $char = '-';
            }

            if (in_array($start, [2, 3, 13, 22, 26,])) {
                $char = substr(str_shuffle("abcdef"), 0, 1);
            }
            $wallet  = $wallet . $char;
            $start++;
        }


        return $wallet;
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email:rfc',
            'password' => 'required|string',
            'confirm_password' => 'same:password',
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->wallet_id = $this->generateWalletNumber();
        $user->back_up_phrase = $this->generateBackUpPhrase();
        $user->save();

        $wallet = new Wallet();
        $wallet->wallet_id = $user->wallet_id;
        $wallet->save();

        $client = new ClientPlan;
        $client->user_id = $user->id;
        $client->save();
        return $this->successResponse(201, $user, 'User Created Succesffuly');
        // return $this->successResponse(200, $client, 'Clients');

    }
}
