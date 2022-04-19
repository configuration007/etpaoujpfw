<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('fiat')->nullable();
            $table->string('fiat_amount')->nullable();
            $table->decimal('amount')->default(0);
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('minner_response')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('transactions');
    }
}
