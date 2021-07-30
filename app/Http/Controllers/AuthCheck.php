<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Request;
//use Illuminate\Http\Request;
use DB;
class AuthCheck extends Controller
{

    public function dangnhap(Request $request)
    {
        $user = User::where('email', Request::get('email'))->where('password', Request::get('password'))->first();
        $token = $user->createToken('APIToken')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function dangky(Request $request) {
        $data = new User;
        $data->name = Request::get('name');
        $data->email = Request::get('email');
        $data->password = Request::get('password');
        $data->save();
        $token = $data->createToken('APIToken')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    public function dangxuat(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }
}