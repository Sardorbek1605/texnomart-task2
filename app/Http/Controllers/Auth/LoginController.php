<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwtauth', ['except' => ['sendSMS', 'loginOrRegister']]);
    }

    /**
     * Get a verification code with phone number.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSMS(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $phone = $request->input('phone');
        $verification_code = rand(100000, 999999);
        cache([$phone => $verification_code], now()->addMinutes(2));

        // Bu qism vaqtinchalik olib turilibdi, shunki realniy sms api bolmaganligi sabab

        /*$sendSMS = Http::post('http://127.0.0.1:8001/api/fake/sms', [
            'phone' => $phone,
            'message' => "Your verification code is $verification_code"
        ]);*/
        $sendSMS = true;
        if ($sendSMS/*->status() == '200'*/){
            return response()->json([
                'success' => true,
                'message' => "Verification code sent to your phone ($verification_code)" //bunda $verification_code sms ga boradigan kodni korvolish uchun, prodga chiqib haqiqiy sms api ulanganda olib tashlanadi!
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => "Verification code cannot send to your phone, if you want another code, please try again!"
            ]);
        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginOrRegister(Request $request){
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);
        $phone = $request->input('phone');
        $verification_code = $request->input('verification_code');
        $stored_code = cache($phone);
        if ($stored_code && $verification_code == $stored_code) {
            $user = User::firstOrCreate(['phone' => $phone]);
            $token = JWTAuth::fromUser($user);
            Auth::login($user);
            cache()->forget($phone);
            return $this->respondWithToken($token);
        }else{
            return response()->errorJson("Verification code isn't correct!");
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
