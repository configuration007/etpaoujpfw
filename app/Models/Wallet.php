<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    static function credit($walletId ,$amount){
        $wallet = self::where('wallet_id' , $walletId)->first();
        $wallet->bitcoin = $wallet->bitcoin + $amount;
        $wallet->save();

        return $wallet;
    }

    static function debit($walletId ,$amount){
        $wallet = self::where('wallet_id' , $walletId)->first();
        $wallet->bitcoin = $wallet->bitcoin - $amount;
        $wallet->save();

        return $wallet;
    }
}
