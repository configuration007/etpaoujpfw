<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Api\HelpersTrait;

class VerificationController extends BaseController
{
    use HelpersTrait;

    public function generateVerificationLink($user_id)
    {
        $sentTime = Carbon::now()->toDateTimeString();
        $url = $sentTime . '|' . $user_id;
        $encyrpted_url = Crypt::encrypt($url);
        return  '/email-verification?token=' . $encyrpted_url;
    }


    public function verifyEmail(Request $request)
    {

        $encyrpted_url = $request->get('token');

        $decrypted_url =  Crypt::decrypt($encyrpted_url);

        $data = explode('|', $decrypted_url);


        if (!isset($data[0]) || !isset($data[1])) {
            throw new ApiException('Invalid Token pattern');
        }

        $time_gap = Carbon::now()->diffInMinutes($data[0]);

        if ($time_gap > 10) {
            throw new ApiException('Token has expired, try again');
        }

        $user = User::find($data[1]);
        if (!$user) {
            throw new ApiException('Invalid Token submitted');
        }

        if ($user->email_verified_at) {
            throw new ApiException('Account already verified');
        }

        $user->email_verified_at = now();
        $user->save();

        $this->log($user->id, 'Email Verified email');

        return $this->successResponse(201, $user, 'User Verified succesfully');
    }

    public function sendVerificationEmail(Request $request)
    {
        $email = $request->get('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new ApiException('Invalid email presented');
        }

        if ($user->email_verified_at) {
            throw new ApiException('Account already verified');
        }
        
        $url = $this->generateVerificationLink($user->id);
        try {
            Mail::send(
                'emails.verify',
                [
                    'user' => $user,
                    'url' => $url
                ],
                function ($message) use ($user) {
                    $message->to($user->email)
                        ->subject('Please Verify Your Email Address');
                    $message->from('notify@remotemining.net');
                }
            );
            $this->log($user->id, 'Email Verification Sent');
        } catch (Exception $e) {

            return $this->successResponse(400, null, $e->getMessage());
        }

        return $this->successResponse(201, $user, 'Verification email sent  Succesfully');
    }
}
