<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\helpers\GlobalFunction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                try {
                    $token = $user->createToken('accessToken')->accessToken;

                    return response()->json([
                        'access_token' => $token,
                        'user' => $user,
                        'message' => 'Login successful',
                    ], 200);
                } catch (\Exception $e) {
                    return response()->json([
                        'message' => 'Token generation failed',
                    ], 500);
                }
            } else {
                Auth::logout();
                return response()->json([
                    'message' => 'Permission denied. Only admin can login',
                ], 403);
            }
        } else {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $request->user()->token()->revoke();

            return response()->json(['message' => 'Logged out successfully'], 200);
        }

        return response()->json(['message' => 'Logout failed'], 403);
    }

    public function customerRegister(Request $request)
    {
        // Validate request data
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female'],
            'phone' => ['required', 'unique:customers,phone', 'max:14', 'min:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers,email'],
            'password' => ['required', 'string', 'min:8', 'max:128'],
        ], [
            'phone.required' => 'Phone is required',
            'phone.min' => 'Phone may not be less than 9 characters',
            'phone.max' => 'Phone may not be greater than 14 characters',
            'phone.unique' => 'Phone number already exists',
        ]);

        try {
            $customer = new Customer;

            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->gender = $request->gender;
            $customer->phone = $request->phone;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password);
            $customer->email_verified_at = now();
            $customer->locale = app()->getLocale();
            $customer->timezone = config('app.timezone');
            $customer->token = Str::random(64);

            $customer->save();

            $tokenResult = $customer->createToken('Customer Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'message' => 'Customer registered successfully!',
                'access_token' => $tokenResult->accessToken,
                'customer' => $customer,
            ], 201);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'message' => 'Registration failed. Please try again.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function customerLogin(Request $request)
    {
        // Validate request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $customer = Auth::user();

            $customer->tokens->each(function ($token) {
                $token->revoke();
                // $token->delete(); // For Sanctum
            });

            // Create a new token
            $tokenResult = $customer->createToken('CustomerAccessToken');
            $token = $tokenResult->token;
            $token->save();

            return response()->json([
                'access_token' => $tokenResult->accessToken,
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // public function generateOTP(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error'=>$validator->errors()], 401);
    //     }

    //     try{
    //         $to = $request->phone;
    //         $otp = rand(100000,999999);
    //         $token = Str::random(150);
    //         $response = GlobalFunction::sendOTP($to,$otp);
    //         if($response){
    //             $data['otp'] = $otp;
    //             $data['_token'] = $token;
    //             return response()->json($data,200);
    //         }else{
    //             $data = [
    //                 'message'=> 'Failed to send OTP',
    //             ];
    //         }
    //     }catch (\Exception $e) {
    //         $data = [
    //             'message'   => $e->getMessage()
    //         ];
    //         return response()->json($data,400);
    //     }
    // }


    // public function verifyOTP(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required',
    //         'otp' => 'required|numeric',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 401);
    //     }

    //     try {
    //         $phone = $request->phone;
    //         $otp = $request->otp;

    //         $cachedOtp = Cache::get('otp_' . $phone);
    //         if ($otp != $cachedOtp) {
    //             return response()->json(['message' => 'Invalid OTP'], 400);
    //         }

    //         $customer = Customer::where('phone', $phone)->first();
    //         if (!$customer) {
    //             return response()->json(['message' => 'Customer not found'], 404);
    //         }

    //         $apiToken = Str::random(80);
    //         $customer->token = $apiToken;
    //         $customer->save();
    //         Cache::forget('otp_' . $phone);

    //         return response()->json(['token' => $apiToken], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 400);
    //     }
    // }

    // public function registerCustomer(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'token' => 'required',
    //         'name' => 'required|string|max:255',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 401);
    //     }

    //     try {
    //         $customer = Customer::where('token', $request->token)->first();
    //         if (!$customer) {
    //             return response()->json(['message' => 'Invalid token or customer not found'], 404);
    //         }
    //         $customer->name = $request->name;
    //         $customer->password = bcrypt($request->password);
    //         $customer->save();

    //         $customer_info = [
    //             'token' => $customer->token,
    //             'id' => $customer->id,
    //             'name' => $customer->name,
    //             'phone' => $customer->phone,
    //             'email' => $customer->email,
    //             'image_url' => $customer->image_url,
    //         ];

    //         return response()->json([
    //             'message' => 'Customer registered successfully',
    //             'success' => true,
    //             'customer_info' => $customer_info,
    //         ], 200);

    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 400);
    //     }
    // }

    public function registerPhoneOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try {
            $phone = $request->phone;

            $existingCustomer = Customer::where('phone', $phone)->first();
            if ($existingCustomer && $existingCustomer->is_verify == 1) {
                return response()->json(['message' => 'Phone number has already been registered'], 400);
            }

            $otp = rand(100000, 999999);
            Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

            $response = GlobalFunction::sendOTP($phone, $otp);

            if ($response) {
                if (!$existingCustomer) {
                    $customer = new Customer();
                    $customer->name = $phone;
                    $customer->phone = $phone;
                    $customer->password = Hash::make('default_password');
                    $customer->save();
                }

                return response()->json(['otp' => $otp], 200);
            } else {
                return response()->json(['message' => 'Failed to send OTP'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'otp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try {
            $phone = $request->phone;
            $otp = $request->otp;

            $cachedOtp = Cache::get('otp_' . $phone);
            if ($otp != $cachedOtp) {
                return response()->json(['message' => 'Phone and OTP do not match'], 400);
            }

            $name = $request->name;
            $password = $request->password;
            $confirmPassword = $request->confirm_password;

            $additionalValidator = Validator::make($request->all(), [
                'name' => 'required|string',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|min:6',
            ]);

            if ($additionalValidator->fails()) {
                return response()->json(['error' => $additionalValidator->errors()], 400);
            }

            if ($password !== $confirmPassword) {
                return response()->json(['message' => 'Password and confirm password do not match'], 400);
            }

            $customer = Customer::where('phone', $phone)->first();
            if (!$customer) {
                $customer = new Customer();
                $customer->phone = $phone;
            }

            $customer->name = $name;
            $customer->is_verify = 1;
            if (!empty($password)) {
                $customer->password = $password;
            }
            $customer->save();

            $apiToken = $customer->createToken('PhoneLogin')->accessToken;
            Cache::forget('otp_' . $phone);
            $customer_info = [
                'token' => $apiToken,
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'image_url' => $customer->image_url,
                'is_verify' => $customer->is_verify,
            ];

            return response()->json([
                'message' => 'Registered and logged in successfully',
                'success' => true,
                'customer_info' => $customer_info,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function loginPhoneOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try {
            $credentials = $request->only('phone', 'password');
            $customer = Customer::where('phone', $credentials['phone'])->first();

            if (!$customer || !Hash::check($credentials['password'], $customer->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $customer->tokens->each(function ($token) {
                $token->delete();
            });

            $token = $customer->createToken('PhoneLogin')->accessToken;

            $customer_info = [
                'token' => $token,
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'image_url' => $customer->image_url,
                'is_verify' => $customer->is_verify,
            ];

            return response()->json([
                'message' => 'Login successful',
                'success' => true,
                'customer_info' => $customer_info,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function logoutCustomer(Request $request)
    {
        try {
            $customer = $request->user();

            $customer->tokens->each(function ($token) {
                $token->delete();
            });

            return response()->json([
                'message' => 'Logged out successfully',
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $phone = $request->phone;
        $customer = Customer::where('phone', $phone)->first();

        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $otp = rand(100000, 999999);
        Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

        $response = GlobalFunction::sendOTP($phone, $otp);
        if ($response) {
            return response()->json(['otp' => $otp], 200);
        } else {
            return response()->json(['message' => 'Failed to send OTP'], 500);
        }
    }

    public function verifyOTPAndResetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|string',
            'otp' => 'required|numeric',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $phone = $request->phone;
        $otp = $request->otp;
        $newPassword = $request->new_password;

        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp || $cachedOtp != $otp) {
            return response()->json(['message' => 'Phone number and OTP do not match'], 400);
        }

        $customer = Customer::where('phone', $phone)->first();
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->password = $newPassword;
        $customer->save();

        Cache::forget('otp_' . $phone);

        return response()->json([
            'message' => 'Password has been reset successfully',
            'success' => true,
        ], 200);
    }

    private function findOrCreateCustomer($providerCustomer, $provider)
    {
        $customer = Customer::where('email', $providerCustomer->email)->first();

        if (!$customer) {
            $customer = Customer::create([
                'image_url' => $providerCustomer->avatar,
                'name' => $providerCustomer->name,
                'email' => $providerCustomer->email,
                'provider' => $provider,
                'provider_id' => $providerCustomer->id,
            ]);
        }

        return $customer;
    }

    public function googleLogin(Request $request)
    {
        $providerCustomer = Socialite::driver('google')->stateless()->customerFromToken($request->access_token);

        $customer = $this->findOrCreateCustomer($providerCustomer, 'google');

        $token = JWTAuth::fromUser($customer);

        return response()->json(compact('token'));
    }
}
