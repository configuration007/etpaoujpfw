<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientPlan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barcode()
    {
        return $this->hasOne(AdminWallet::class, 'id','admin_wallet_id');
    }
}
