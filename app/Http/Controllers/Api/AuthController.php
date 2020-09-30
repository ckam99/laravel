<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login', 'register', 'forgotPassword', 'resetPassword']]);
        // $this->guard = 'api';
    }

    public function list(Request $request)
    {
        try {
            return response()->json(User::all());
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            if (Auth::attempt($request->all())) {
                /** @var User $user */
                $user = Auth::user();
                return response()->json([
                    'access_token' => $user->createToken('app')->accessToken,
                    'meta' => Auth::user()
                ]);
            }
            return response()->json(['error' => 'Bad credentials'], 401);
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => Hash::make($request->password)]
            ));
            return response()->json($user, 201);
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function me()
    {
        try {
            return response()->json(Auth::user());
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json('', 204);
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), ['email' => 'required|email|exists:users']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $token = Str::random(16);
        $email = $request->email;

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);

            Mail::send('mails.forgot-password', ['token' => $token], function (Message $message) use ($email) {
                $message->to($email);
                $message->subject('Reset password');
            });

            return response(['message' => 'Check your mail!']);
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {
            if (!$passwordResets = DB::table('password_resets')->where('token', $request->token)->first()) {
                return response()->json(['error' => 'Invalid token'], 400);
            }
            if (!$user = User::where('email', $passwordResets->email)->first()) {
                return response()->json(['error' => `$passwordResets->email doesn't exist!`], 404);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json($user);
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:6',
            'password_confirm' => 'same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        try {

            if (Hash::check($request->old_password, Auth::user()->password)) {
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->password);
                $user->save();
                $request->user()->token()->revoke();
                return response('', 204);
            }
            return response()->json(['error' => 'Current password is not correct.']);
        } catch (\Exception $except) {
            return $this->except_handler($except);
        }
    }

    protected function except_handler($exception)
    {
        return response()->json(['error' => $exception->getMessage()], 400);
    }
}