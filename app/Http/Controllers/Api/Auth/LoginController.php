<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exceptions\ApiException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController;

class LoginController extends BaseController
{
    
    public function loginAdmin(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            throw new ApiException('Invalid Email | password combination');
        }

        $user = $request->user();

        return response()->json([
            'token' => $user->createToken('Personal Access Token')->accessToken,
            'user' => $user,
        ]);
    }
    public function login(Request $request)
    {

        $this->validate($request, [
            'wallet_id' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('wallet_id', $request->wallet_id)->first();

        if (!$user) {
            throw new ApiException('Invalid wallet ID | password combination');
        }

        $request->merge(['email' => $user->email]);

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            throw new ApiException('invalid wallet ID | password combination');
        }

        $user = $request->user();

        return response()->json([
            'token' => $user->createToken('Personal Access Token')->accessToken,
            'user' => $user,
        ]);
    }

}
