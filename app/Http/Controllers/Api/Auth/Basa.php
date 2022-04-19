<?php

namespace App\Http\Controllers\api;

use App\User;
use Throwable;
use App\Company;
use App\AdminRole;
use App\RoleControl;
use App\PasswordReset;
use PHPUnit\Exception;
use Twilio\Rest\Client;
use App\UserVerification;
use Illuminate\Support\Str;
use App\Traits\GlobalScopes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Traits\NotificationScopes;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Traits\Permission as UserPermission;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthenticationController extends Controller
{
    use  UserPermission, GlobalScopes;
    public function register(Request $request)
    {
        $this->validate($request, [
            'phone_no' => 'required|string|numeric',
            'email' => 'required|unique:users|email:rfc',
            'password' => 'required|string',
            'password_confirmed' => 'same:password',
            'name' => 'required',
            'user_type' => 'required',
        ]);
        try {
            if ($request->user_type == 'operator') {
                $code = $this->genCode('OPT');
            } else {
                $code = $this->genCode('AGT');
            }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'password' => bcrypt($request->password),
                'user_type' => $request->user_type,
                'user_code' => $code
            ]);
            return response()->json(['message' => 'Account Created', 'status' => 'unverified', 'user_id' => $user->id], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function sendValidationMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email,' . $request->id,
        ]);
        try {
            $old_record_check = UserVerification::where('email', $request->email);
            if ($old_record_check->first() != null) {
                $old_record_check->delete();
            }
            $random_code = Str::random(4);
            $random_string = Str::random(100);
            $data =  UserVerification::create([
                'email' => $request->email,
                'email_old' => $request->email_old,
                'verificatioin_code' => $random_code,
                'verification_string' => $random_string,
            ]);
            $data['reference_url'] = 'verifyemail/' . $data->verification_string;

            if (config('app.env') == 'production') {
                // try {
                //     $account_sid =  config('default.twilio_account_sid');
                //     $auth_token =  config('default.twilio_auth_token');
                //     $twilio_number =  config('default.twilio_twilio_number');
                //     $twilio_from = config('default.twilio_twilio_from');

                //     $client = new Client($account_sid, $auth_token);
                //     $client->messages->create(
                //         $twilio_from,
                //         ['from' => $twilio_number, 'body' => 'Your Validation code is ' . $random_code]
                //     );
                // } catch (Throwable  $e) {
                //      app('sentry')->captureException($e);
                // }
            }

            try {
                Mail::send('emails.verification', ['data' => $data], function ($message) use ($data) {
                    $message->to($data->email)
                        ->subject('ESLC');
                    $message->from('support@eslc.com.ng');
                });
            } catch (Exception $e) {
                 app('sentry')->captureException($e);
                return response()->json(
                    $e->getMessage(),
                    500
                );
            }
            return response()->json(['message' => 'sent'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function confirmValidationCode(Request $request)
    {
      
            if ($request->v_code === null) {
                throw ValidationException::withMessages(['v_code' => 'Enter Verification Code']);
            }

          $data_0 = UserVerification::whereIn(DB::raw('BINARY `verificatioin_code`'), array($request->v_code));  
          //CASE SENSITIVE          
            $data_1 = $data_0->first();
            if ($data_1 == null) {
                throw ValidationException::withMessages(['v_code' => 'Invalid Code(Case Sensitive)']);
            }
            try {
            if ($data_1->minute_diff > 3) {
                $data_0->delete();
                return response([
                    'message' => 'email verified expired',
                    'status' => 'is_expired'
                ], 201);
            }
            if ($data_1->email_old != $data_1->email) {
                //check if user change email while registering
                User::where('email', $data_1->email)->update([
                    'email_verified_at' => Carbon::now(),
                    'email' => $data_1->email
                ]);
            } else {
                User::where('email', $data_1->email)->update([
                    'email_verified_at' => Carbon::now(),
                ]);
            }
            $data_0->delete();
            return response([
                'message' => 'email verified',
                'status' => 'is_verified'
            ], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function getuserEmail($id)
    {
        try {
            $data_0 = UserVerification::where('verification_string', $id);
            $data_1 = $data_0->first();
            if ($data_1 === null) {
                $data =  User::find($id);

                if ($data === null) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'error' => ['Invalid Or Expired Token'],
                    ]);
                }
                if ($data->email_verified_at === null) {
                    return response()->json(
                        [
                            'message' => 'email verified',
                            'status' => 'is_unverified',
                            'email' => $data->email,
                            'phone_no' => $data->phone_no
                        ],
                        201
                    );
                } else {
                    return response([
                        'message' => 'email verified',
                        'status' => 'is_verified'
                    ], 201);
                }
            } else {

                if ($data_1->minute_diff > 3) {
                    $data_0->delete();
                    return response([
                        'message' => 'email verified expired',
                        'status' => 'is_expired'
                    ], 201);
                }
                if ($data_1->email_old != $data_1->email) {
                    User::where('email', $data_1->email)->update([
                        'email_verified_at' => Carbon::now(),
                        'email' => $data_1->email
                    ]);
                } else {
                    User::where('email', $data_1->email)->update([
                        'email_verified_at' => Carbon::now(),
                    ]);
                }
                $data_0->delete();
                return response([
                    'message' => 'email verified',
                    'status' => 'is_verified'
                ], 201);
            }
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }


    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        try {
            $user_email = User::where('email', $request->email);
            $user_email_1 = $user_email->first(['name', 'email']);
            if ($user_email_1 == null) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'email' => 'We have no record of this Email',
                ]);
            }
            $random_string = Str::random(100);
            PasswordReset::create([
                'email' => $request->email,
                'token' => $random_string,
            ]);
            $user_email_1['reference_url'] = 'reset_password/' . $random_string;

            Mail::send('emails.reset', ['data' => $user_email_1], function ($message) use ($user_email_1) {
                $message->to($user_email_1['email'])
                    ->subject('Ekiti State Lotteries Commission');
                $message->from('support@eslc.com.ng');
            });
            return response()->json([
                'status' => 'success',
                'message' => 'Reset Password Sent to your Email'
            ], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function getResetDefault($id)
    {
        try {
            $data =  PasswordReset::where('token', $id)->first();
            if ($data == null) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'invalid' => 'We have no record of this Token',
                ]);
            } else  if ($data->minute_diff > 3) {
                return response()->json([
                    'status' => 'is_expired',
                    'message' => 'Your Token Has Expired'
                ], 201);
            } else {
                $user_id = User::where('email', $data->email)->first()->id;
                return response()->json([
                    'status' => 'valid',
                    'message' => 'Reset Password',
                    'user_id' => $user_id
                ], 201);
            }
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function resetPassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|string',
            'password_confirmed' => 'same:password',
        ]);
        try {
            $data_0 =  PasswordReset::where('token', $id);
            $data = $data_0->first();
            if ($data->minute_diff > 4) {
                $data_0->delete();
                return response()->json([
                    'status' => 'is_expired',
                    'message' => 'Your Token Has Expired'
                ], 201);
            } else {
                $data_0->delete();
                User::where('email', $data->email)->update([
                    'password' => bcrypt($request->password)
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Password Reset Successful'
                ], 201);
            }
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function allUserEmail()
    {
        try {
            $data = User::all('email');
            return response()->json($data, 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function login(Request $request)
    {
        // return $request;
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        try {
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'invalidcombo' => 'invalid email/password combination',
                ]);
            }
            $user = $request->user();

            if ($user->email_verified_at == null) {
                return response()->json(['status' => 'unverified', 'user_id' => $user->id], 201);
            }
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addDays(1);
            $token->save();
            return response()->json([
                'token' => $tokenResult->accessToken,
                'status' => 'verified',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()

            ]);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function usertype(Request $request)
    {
        try {
            $id = auth('api')->user()->id;
            $user_update = User::where('id', $id)->update([
                'user_type' => $request->user_type,
            ]);
            $user = $request->user();
            return response()->json([
                'user_type' => $request->user_type,
            ]);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function logout(Request $request)
    {
        try {
            $loggedInUSer = Auth::user();
            if ($loggedInUSer == null) {
                $accessToken = User::where('email', $request->email)->first()->token();
            } else {
                $accessToken = Auth::user()->token();
            }
            $token = $request->user()->tokens->find($accessToken);
            $token->revoke();
            $response['msg'] = "Successfully logout";
            return response()->json($response, 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function user(Request $request)
    {
        return response()->json(['data' => $request->user()], 201);
    }
    // https://medium.com/graymatrix/using-gmail-smtp-server-to-send-email-in-laravel-91c0800f9662
    public function AdminRegister(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email:rfc',
            'access_level' => 'required|string',
            'password_confirmed' => 'same:password',
            'staff_name' => 'required',
            'phone_no' => 'required',
        ]);
        try {
            $time = Carbon::now();
            $code = $this->genCode('ADM');
            $user = User::create([
                'name' => $request->staff_name,
                'email' => $request->email,
                'role_id' => $request->access_level,
                'phone_no' => $request->phone_no,
                'email_verified_at' => $time,
                'password' => bcrypt('Ekiti_123456789'),
                'user_type' => 'admin',
                'user_code' => $code
            ]);
            return response()->json(['message' => 'Staff Record Created'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function adminUpdate($id, Request $request)
    {
        $this->validate($request, [
            // 'phone_no' => 'required|string',
            'email' => 'unique:users,email,' . $request->id,
            'access_level' => 'required|string',
            'password_confirmed' => 'same:password',
            'staff_name' => 'required',
            'phone_no' => 'required',
        ]);
        try {
            $user = User::where('id', $id)->update([
                'name' => $request->staff_name,
                'email' => $request->email,
                'role_id' => $request->access_level,
                'phone_no' => $request->phone_no,
                'user_type' => 'admin',
            ]);
            return response()->json(['message' => 'Staff Record Updated'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }


    public function getAdminRegisters($id)
    {
        return  $this->userPermission();
    }
    public function getAdminRegister(Request $request)
    {
        try {
            $sorting = $this->sortOrder($request);
            $data = User::where('user_type', 'admin')
                ->Where('name', 'LIKE', '%' . $sorting['filter'] . '%')
                ->whereNull('tag')
                ->orderBy($sorting['sort'], $sorting['by'])->paginate(12);
            return response()->json(
                $data,
                201
            );
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function addRoles(Request $request)
    {
        $request->validate([
            'role_name' => 'required|unique:admin_roles,name',
        ]);
        try {
            $role = AdminRole::create(['name' => $request->role_name]);

            $request->request->add([
                'role_id' => $role->id
            ]);

            $this->updatePermissions($request);
            return response()->json(['message' => 'Role Created', 'id' => $role->id], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function getRoles(Request $request)
    {
        try {
            $roles = AdminRole::whereNull('tag')->paginate(12);
            return response()->json($roles, 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function getUserRoles(Request $request)
    {
        try {
            $data = AdminRole::whereNull('tag')->get();

            return response()->json($data, 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function updateRoles(Request $request, $id)
    {

        $role = AdminRole::where('id', $id);
        $request->validate([
            'role_name' => 'required|unique:admin_roles,name,' . $role->first()->id
        ]);
        try {
            $role->update(['name' => $request->role_name]);
            return response()->json(['message' => 'Role Upddated'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function deleteRole($id)
    {
        try {
            AdminRole::where('id', $id)->delete();
            RoleControl::where('role_id', $id)->delete();
            return response()->json(['message' => 'Role Deleted'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function updatePermissions(Request $request)
    {
        try {
            $role = RoleControl::where('role_id', $request->role_id);
            if ($role->count() < 1) {
                RoleControl::Create([
                    'role_id' => $request->role_id,
                    'permission' => json_encode($request->permissions)
                ]);
            } else {
                $role->update([
                    'permission' => json_encode($request->permissions)
                ]);
            };
            return response()->json(['message' => 'Role Updated'], 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
    public function getPermissions($id)
    {
        try {
            $permissions = AdminRole::where('id', $id)->with('permissions')->first();
            return response()->json($permissions, 201);
        } catch (Exception $e) {
             app('sentry')->captureException($e);
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }
}
