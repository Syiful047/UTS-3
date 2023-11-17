<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //membuat fitur register
    public function register(Request $request) {
        // menangkap inputan
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        // mengensert data ke table user
        $user = User::create($input);
        $data = [
            'message' => 'User is create successfully'
        ];

        // mengirim response JSON
        return response()->json($data, 200);
    }

    // membuat fitur login
    public function login(Request $request) {
        // menangkap input user
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // melakukan autentikasi
        if (Auth::attempt($input)) {
            // /membuat token
            $token = Auth::user()->createToken('auth_token');
            $data = [
                'message' => 'login successfully',
                'token' => $token->plainTextToken
            ];

            // mengambilkan response JSON
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Username or password is wrong'
            ];

            return response()->json($data, 401);
        }
    }
}
