<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function signUp(Request $request) {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        return response()->json($user);
    }

    public function signIn(Request $request) {
        $params = $request->only( [ 'email', 'password' ] );
        if(Auth::attempt($params)) {
            $user = User::where('email', $params['email'])->first();
            $token = $user->createToken(env('APP_KEY'));
            return response()->json([
                "user" => $user,
                "token" => $token->plainTextToken
            ]);
        } else {
            return response()->json( ['message' => '로그인 정보를 확인하세요'], 400 );    
        }
    }
}