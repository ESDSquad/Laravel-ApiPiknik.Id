<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Validator;
use Auth;
use Hash;

use App\Models\User;

class UserController extends BaseController
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Login failed', 422, $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            $response = [
                'token' => $user->createToken('MyToken')->accessToken,
                'user_id' => $user->id,
                'nama_lengkap' => $user->nama_lengkap,
                'email' => $user->email,
            ];

            return $this->responseOk($response);
        } else {
            return $this->responseError('Wrong email or password', 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->responseError('Registration failed', 422, $validator->errors());
        }

        $params = [
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($user = User::create($params)) {
            $token = $user->createToken('MyToken')->accessToken;

            $response = [
                'token' => $token,
                'user' => $user,
            ];

            return $this->responseOk($response);
        } else {
            return $this->responseError('Registration failed', 400);
        }
    }

    public function profile(Request $request)
    {
        return $this->responseOk($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->responseOk(null, 200, 'Logged out successfully.');
    }
}
