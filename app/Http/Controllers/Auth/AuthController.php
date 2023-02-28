<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( RegisterRequest $request): UserResource
    {
        $user = User::create([
            'name'      => ucwords( $request->name ),
            'email'     => strtolower( $request->email ),
            'password'  => Hash::make( $request->password )
        ]);

        return new UserResource( $user );

    }

    public function login( LoginRequest $request ): \Illuminate\Http\JsonResponse
    {
        $credentials = [
            'email'     => trim( strtolower( $request->email ) ),
            'password'  => trim( $request->password )
        ];

        if ( Auth::attempt( $credentials ) ) {
            $user = User::where( 'email', $request->email )
                ->first();

            // $token_response = explode( '|', $token->plainTextToken );

            return response()->json([
                'token'     => 'logged in',
                'id'        => $user->id
            ]);

        } else {
            return response()->json([
                'errors'    => [
                    'database'  => 'Email address/password combination not found'
                ]
            ], 422 );
        }
    }

}
