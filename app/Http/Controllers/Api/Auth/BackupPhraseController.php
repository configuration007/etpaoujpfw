<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController;

class BackupPhraseController extends BaseController
{
    public function regenerateBackupPhrase($phrase)
    {
        $words = explode(" ", $phrase);
        $text = '';
        $i = 0;
        while ($i < 12) {

            $w = $words[$i];
            $text = $text . $w;
            if ($i != 11) {
                $text = $text . '|';
            }

            $i++;
        }
        return $text;
    }

    public function generateBackupLink($user_id)
    {
        $sentTime = Carbon::now()->toDateTimeString();
        $url = $sentTime . '|' . $user_id;
        $encyrpted_url = Crypt::encrypt($url);
        return   $encyrpted_url;
    }

    public function backUpPhase(Request $request)
    {

        $this->validate($request, [
            'backup_phrase' => 'required|string',
        ]);

        $back_up_phrase = $this->regenerateBackupPhrase($request->backup_phrase);

        $user = User::where('back_up_phrase', $back_up_phrase)->first();

        if (!$user) {
            throw new ApiException('invalid  Backup phrase');
        }

        $backup_token = $this->generateBackupLink($user->id);

        return $this->successResponse(200, ['backup_token' => $backup_token], 'User Created Succesffuly');
    }


    public function backUpReset(Request $request)
    {
        $this->validate($request, [
            'verification_token' => 'required|string',
            'password' => 'required|string',
            'confirm_password' => 'same:password',
        ]);

        $encyrpted_token = $request->get('verification_token');

        $encyrpted_token =  Crypt::decrypt($encyrpted_token);

        $data = explode('|', $encyrpted_token);


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

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return $this->successResponse(201, $user, 'Password changed successfully');
    }
}
