<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Complain;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }
    public function message(Request $request)
    {
        $complain =  new  Complain();
        $complain->email = $request->email;
        $complain->subject = $request->subject;
        $complain->message = $request->message;
        $complain->save();

        $code = Str::random(10);
        try {
            Mail::send(
                'emails.complain',
                [
                    'code' => $code
                ],
                function ($message) use ($complain) {
                    $message->to($complain->email)
                        ->subject(config('mail.mail_subject_header'));
                    $message->from(config('mail.mail_subject_email'));
                }
            );
        } catch (Exception $e) {

            return $this->successResponse(201, null, $e->getMessage());
        }

        return view('pages.contact');
    }

    
}
