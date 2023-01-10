<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'nomor_hp' => ['required'],
            'foto' => ['required','mimes:png,jpg,jpeg'],
            'password' => ['required', 'min:8'],
        ]);
        if ($validate->fails()) {
            return response()->validation($validate->messages());
        } else {
            $file = $request->file('foto');
            $fileUrl = Storage::disk('public')->putFile(
                'user',
                $file
            );

            $register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 2,
                'nomor_hp' => $request->nomor_hp,
                'foto' => $fileUrl,
            ]);

            return response()->success("Selemat Akun ada berhasil dibuat, silahkan login..", new UserResource($register));
        }
    }
}
