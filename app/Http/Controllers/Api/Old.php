<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ClientAccess;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\MiningAccount;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;

class SystemController extends BaseController
{
    public function scdcsdcsd(Request $request)
    {
        return $request->all();
    }

    public function getUserNotification()
    {
        $data = Notification::where('access_id', auth('api')->user()->clientaccess['id'])->get();
        return $data;
    }

    public function getUserSecurity()
    {
        $data = file_get_contents('https://api.myip.com/');
        return $data;
    }

    public function getUser()
    {
        $data['user'] = auth('api')->user();
        $data['user_access'] = auth('api')->user()->clientaccess['access_id'];
        $data['user_notification'] = Notification::where('access_id', auth('api')->user()->clientaccess['id'])->get();

        return $data;
    }
    public function getCurrentPriceX($id)
    {
        // return'yes';
        $small_id = strtolower($id);
        $account_balance = auth('api')->user()->minning['mining_balance_' . $small_id];
        try {
            $USD = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=' . $id . '&tsyms=USD'));
            $GBP = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=' . $id . '&tsyms=GBP'));
            $EUR = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=' . $id . '&tsyms=EUR'));
            $JPY = json_decode(file_get_contents('https://min-api.cryptocompare.com/data/price?fsym=' . $id . '&tsyms=JPY'));
        } catch (Exception $e) {
        };

        $data  = [
            'USD' => $USD ? $account_balance * $USD : $account_balance,
            'GBP' => $GBP ? $account_balance * $GBP : $account_balance,
            'EUR' => $EUR ? $account_balance * $EUR : $account_balance,
            'JPY' => $JPY ? $account_balance * $JPY : $account_balance,
        ];
        return response()->json($data);
    }



    public function getCurrentPrice($currency)
    {
        $account_balance = auth('api')->user()->minning['mining_balance_' . $currency];



        $usd =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=' . $currency), true)[0]['current_price'];
        $eur =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=eur&ids=' . $currency), true)[0]['current_price'];
        $gbp =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=gbp&ids=' . $currency), true)[0]['current_price'];
        $jpy =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=jpy&ids=' . $currency), true)[0]['current_price'];
        $data['currency']  = [
            'usd' => number_format((float)$usd ? $account_balance * $usd : $account_balance, 2),
            'gbp' => number_format((float)$eur ? $account_balance * $eur : $account_balance, 2),
            'eur' => number_format((float)$gbp ? $account_balance * $gbp : $account_balance, 2),
            'jpy' => number_format((float)$jpy ? $account_balance * $jpy : $account_balance, 2),
        ];

        $data['total'] = $this->getTotalPrice();
        $data['currency_balance'] = $account_balance;
        return $data;
    }

    public function getTotalPrice()
    {
        $a_bitcoin =  auth('api')->user()->minning['mining_balance_bitcoin'];
        $a_ethereum =  auth('api')->user()->minning['mining_balance_ethereum'];
        $a_ripple =  auth('api')->user()->minning['mining_balance_ripple'];
        $a_tether =  auth('api')->user()->minning['mining_balance_tether'];
        $a_stellar =  auth('api')->user()->minning['mining_balance_stellar'];
        $a_algorand =  auth('api')->user()->minning['mining_balance_algorand'];
        $a_litecoin =  auth('api')->user()->minning['mining_balance_litecoin'];
        $a_monero =  auth('api')->user()->minning['mining_balance_monero'];

        $b_bitcoin =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin'), true)[0]['current_price'];
        $b_ethereum =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=ethereum'), true)[0]['current_price'];
        $b_ripple =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=ripple'), true)[0]['current_price'];
        $b_tether =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=tether'), true)[0]['current_price'];
        $b_stellar =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=stellar'), true)[0]['current_price'];
        $b_algorand =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=algorand'), true)[0]['current_price'];
        $b_litecoin =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=litecoin'), true)[0]['current_price'];
        $b_monero =  json_decode(file_get_contents('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=monero'), true)[0]['current_price'];
        $b_total = ($a_bitcoin * $b_bitcoin) +
            ($a_ethereum * $b_ethereum) +
            ($a_ripple * $b_ripple) +
            ($a_tether * $b_tether) +
            ($a_stellar * $b_stellar) +
            ($a_algorand * $b_algorand) +
            ($a_litecoin * $b_litecoin) +
            ($a_monero * $b_monero);
        return number_format((float)$b_total, 2);
    }













    public function getClientEmail($id)
    {
        $data =   ClientAccess::where('access_id', '=', $id);
        if ($data->count() > 0) {
            return $data->first('email');
        } else {
            throw new \Exception('Invalid Blockchain Key');
        }
    }







    public function deleteNotification($id)
    {
        try {
            Notification::where('id', $id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Record Deleted',
            ]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function createNotification(Request $request, $id)
    {
        try {
            Notification::create([
                'access_id' => $id,
                'message' =>  $request->message,
                'type' =>  $request->type,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Record Created',
            ]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function getNotification($id)
    {
        return  Notification::where('access_id', $id)->get();
    }
    public function updateClientMining(Request $request, $id)
    {
        // return $request->input();
        try {
            MiningAccount::where('access_id', $id)->update(
                [
                    'mining_balance_bitcoin' => $request->mining_balance_bitcoin ? $request->mining_balance_bitcoin : '0.00',
                    'mining_balance_ethereum' => $request->mining_balance_ethereum ? $request->mining_balance_ethereum : '0.00',
                    'mining_balance_ripple' => $request->mining_balance_ripple ? $request->mining_balance_ripple : '0.00',
                    'mining_balance_tether' => $request->mining_balance_tether ? $request->mining_balance_tether : '0.00',
                    'mining_balance_stellar' => $request->mining_balance_stellar ? $request->mining_balance_stellar : '0.00',
                    'mining_balance_algorand' => $request->mining_balance_algorand ? $request->mining_balance_algorand : '0.00',
                    'mining_balance_litecoin' => $request->mining_balance_litecoin ? $request->mining_balance_litecoin : '0.00',
                    'mining_balance_monero' => $request->mining_balance_monero ? $request->mining_balance_monero : '0.00',
                ]

            );
            return response()->json([
                'status' => 'success',
                'message' => 'Record Updated',
            ]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function getClientMining($id)
    {
        return  MiningAccount::where('access_id', $id)->first();
    }
    public function deleteClient($id)
    {
        try {
            $client = ClientAccess::where('id', $id);
            User::where('id', $client->first()->user_id)->delete();
            MiningAccount::where('access_id', $id)->delete();
            $client->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Record Delted',
            ]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function viewClient()
    {
        return ClientAccess::orderBy('created_at', 'desc')->with('user')->get();
    }
    public function createClient(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'wallet_id' => ['required', 'string', 'max:255'],
        ]);
        try {
            $user =   User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('Bitcoin@12342'),
                'user_type' => 'user'
            ]);
            $access =  ClientAccess::create([
                'user_id' => $user->id,
                'blockchain_access_key' => Str::random(12),
                'access_id' => $request->wallet_id,
                'email' => $request->email,
            ]);
            MiningAccount::create([
                'user_id' => $user->id,
                'access_id' => $access->id,
                'wallet_id' => $request->wallet_id,
                'mining_balance_bitcoin' => $request->mining_balance_bitcoin ? $request->mining_balance_bitcoin : '0.00',
                'mining_balance_ethereum' => $request->mining_balance_ethereum ? $request->mining_balance_ethereum : '0.00',
                'mining_balance_ripple' => $request->mining_balance_ripple ? $request->mining_balance_ripple : '0.00',
                'mining_balance_tether' => $request->mining_balance_tether ? $request->mining_balance_tether : '0.00',
                'mining_balance_stellar' => $request->mining_balance_stellar ? $request->mining_balance_stellar : '0.00',
                'mining_balance_algorand' => $request->mining_balance_algorand ? $request->mining_balance_algorand : '0.00',
                'mining_balance_litecoin' => $request->mining_balance_litecoin ? $request->mining_balance_litecoin : '0.00',
                'mining_balance_monero' => $request->mining_balance_monero ? $request->mining_balance_monero : '0.00',
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Record Created',
                'access_id' => $access->access_id,
                'blockchain_access_key' => $access->blockchain_access_key,
            ]);
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function loginClient(Request $request)
    {
        $request->validate([
            'blockchain_access_key' => ['required', 'string'],
            'access_id' => ['required', 'string', 'max:255'],
        ]);
        try {
            $user = ClientAccess::where('blockchain_access_key', '=', $request->blockchain_access_key)
                ->where('access_id', '=', $request->access_id);

            if ($user->count() < 1) {
                throw new \Exception('Invalid Set of Keys');
            } else {
                $request->request->add(['email' =>  $user->first()->email, 'password' => 'Bitcoin@12342']);

                $user = User::where('email', $request->email)->first();

                if ($user) {
                    if (Hash::check($request->password, $user->password)) {
                        return response()->json([
                            'token' => $this->createToken($user),
                            'name' => $user->name,
                            'status' => 'verified',
                        ]);
                    } else {
                        return response()->json(["message" => "Password mismatch"], 422);
                    }
                } else {
                    return response()->json(["message" => "User does not exist"], 422);
                }
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
    public function createAdmin(Request $request)
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $count = User::count();
        $new_count = $count + 1;
        try {
            User::create([
                'name' => 'Admin No' . $new_count,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type' => 'admin'
            ]);
            return $this->loginAdmin($request);
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }
    public function createToken($user)
    {
        return $user->createToken('Auth Token')->accessToken;
    }
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        try {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    return response()->json(['token' => $this->createToken($user), 'name' => $user->name], 200);
                } else {
                    return response()->json(["message" => "Password mismatch"], 422);
                }
            } else {
                return response()->json(["message" => "User does not exist"], 422);
            }
        } catch (Exception $e) {
            throw new \Exception($e);
        }
    }
}
