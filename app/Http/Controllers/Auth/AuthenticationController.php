<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [$request]);

        if ($validator->fails()) {
            return response()->validation($validator->messages());
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Silahkan Cek Kembali Email dan Password'],
                ]);
            }

            $token = $user->createToken($request->email)->plainTextToken;

            return response()->json([
                "message" => "Login Berhasil",
                "data" => [
                    'user' => new UserResource($user),
                    'token' => $token,
                ],
            ]);
        }
    }

    public function logout()
    {
        Auth::user()
            ->currentAccessToken()
            ->delete();
        return response()->json([
            "message" => "Success Logout",
        ]);
    }

    public function me()
    {
        $user = Auth::user();
        return $user;
    }
}