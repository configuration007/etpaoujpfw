<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_id');
            $table->string('wallet_address')->nullable();
            $table->decimal('bitcoin')->default(0);
            $table->decimal('ethereum')->default(0);
            $table->decimal('ripple')->default(0);
            $table->decimal('tether')->default(0);
            $table->decimal('stellar')->default(0);
            $table->decimal('algorand')->default(0);
            $table->decimal('litecoin')->default(0);
            $table->decimal('monero')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
