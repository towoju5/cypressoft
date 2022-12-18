<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function process_login(Request $request)
    {
        $this->validate($request, [
            'login_email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (auth()->attempt($credentials, true)) {
            return true;
        } else {
            $result = get_error_response(401, 'Unathorized login', ['error' => 'Invalid login credentials']);
            return response()->json($result);
        }
    }

    public function process_register(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:6',
        ]);

        $data = [
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password)
        ];

        $process = DB::transaction(function () use (&$data) {
            $user = User::create($data);
            $token = explode("|", $user->createToken('auth_token')->plainTextToken);
            $result = [
                'status' => 'success',
                'access_token' => $token[1],
                'token_type' => 'Bearer',
                'data' => $user,
            ];
            return $result;
        });
        return response()->json($process);
    }
}
