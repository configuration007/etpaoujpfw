<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\StackController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\BackupPhraseController;
use App\Http\Controllers\Api\Auth\RegistrationController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [RegistrationController::class, 'register']);
Route::post('/send-email-verification', [VerificationController::class, 'sendVerificationEmail']);
Route::post('/verify-email', [VerificationController::class, 'verifyEmail']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/backup-login', [BackupPhraseController::class, 'backUpPhase']);
Route::post('/backup-reset-password', [BackupPhraseController::class, 'backUpReset']);
Route::get('/get-price/{crypto}/{fiat?}', [StackController::class, 'getPrice']);
Route::get('/get-prices', [StackController::class, 'getPrices']);
Route::get('/get-prices-stat', [StackController::class, 'getPricesStat']);
Route::post('/login-admin',  [LoginController::class, 'loginAdmin']);

Route::group([
    'prefix' => 'client',
    'middleware' => ['auth:api'],
], function () {
    Route::get('/me', [ProfileController::class, "me"]);
    Route::get('/wallet_balance/{id}', [WalletController::class, "walletBalance"]);
    Route::get('/transactions', [ClientController::class, "transactions"]);
    Route::get('/transaction/{id}', [ClientController::class, "unitTransaction"]);
    Route::get('/get_rate', [ClientController::class, "getRates"]);
    Route::get('/get_barcode', [ClientController::class, "getBarcode"]);
    Route::get('/get_backup_phrase', [ClientController::class, "getBackupPhrase"]);
    Route::post('/initiate_transaction', [ClientController::class, "initiateTransaction"]);
    Route::get('/logs', [ClientController::class, "getLogs"]);
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:api'],
], function () {
    Route::get('/clients', [AdminController::class, "clients"]);
    Route::post('/transaction', [AdminController::class, "transaction"]);
    Route::get('/transaction/{id}', [AdminController::class, "unitTransaction"]);
    Route::post('/top_up', [AdminController::class, "topUp"]);
    Route::get('/dest_wallet', [AdminController::class, "getDestWallets"]);
    Route::post('/dest_wallet', [AdminController::class, "createDestWallets"]);
    Route::put('/dest_wallet/{id}', [AdminController::class, "updateDestWallets"]);
    Route::delete('/dest_wallet/{id}', [AdminController::class, "deleteDestWallets"]);
    Route::post('/update_withdrawal_plan', [AdminController::class, "updateWithdrawalPlan"]);
    Route::post('/send_notification', [AdminController::class, "sendNotification"]);
    Route::get('/dest_transaction', [AdminController::class, "getTransactions"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
