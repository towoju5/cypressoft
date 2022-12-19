<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function process_login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'password'  => 'required',
                    'email'     => 'required|email',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                $result = get_error_response(401, 'Invalid login credentials', ['error' => 'Email & Password does not match with our record.']);
                return response()->json($result, 401);
            }

            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data'      =>  [
                    'token' => explode("|", $user->createToken('auth_token')->plainTextToken)[1] //$user->auth_token,
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function process_register(Request $request)
    {
        $validateUser = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'password'  => 'min:6',
                'password_confirmation' => 'required_with:password|same:password|min:6'
            ]
        );

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

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
            $user->auth_token = $token[1];
            $user->save();
            return $result;
        });
        return response()->json($process);
    }
}
