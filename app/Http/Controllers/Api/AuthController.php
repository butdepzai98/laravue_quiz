<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(UserRequest $request)
    {
        $user = User::create([
            'name'  => $request['name'],
            'email'  => $request['email'],
            'phone'  => $request['phone'],
            'image'  => $request['image'],
            'password'  => bcrypt($request['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        $resopnse = [
            'token' =>  $token,
            'status'    => true,
            'code'  => Response::HTTP_OK
        ];

        return response($resopnse, 201);
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                'message'   => 'Logout successful',
                'status'    => true,
                'code'  => Response::HTTP_OK
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors'    => [
                    'status'    => false,
                    'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'   => $e->getMessage(),
                ]
            ]);
        }
    }

    public function login(Request $request)
    {
        $request = $request->validate([
            'email' => 'required|string',
            'password'  => 'required|string'
        ]);

        // Check Email
        $user = User::where('email', $request['email'])->first();

        // Check password
        if(!$user || !Hash::check( $request['password'], $user->password)){
            return response([
                'message'   => 'Bad creds'
            ], 401);
        }
        else{
            $token = $user->createToken('apiToken')->plainTextToken;

            return response()->json([
                'token'   => $token,
                'status'  => true,
                'code'    => Response::HTTP_OK,
                'message' => 'Logout successfully',
            ]);
        }
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }
}
