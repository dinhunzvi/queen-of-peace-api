<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register( RegisterRequest $request): string
    {
        $user = User::create([
            'name'      => ucwords( $request->name ),
            'email'     => strtolower( $request->email ),
            'password'  => Hash::make( $request->password )
        ]);

        return $user->createToken( $request->device_name )->plainTextToken;

    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login( LoginRequest $request )
    {
        $user = User::where( 'email', $request->email )
            ->first();

        if ( !$user || !Hash::check( $request->password, $user->password ) ) {
            throw ValidationException::withMessages([
                'email'     => ['The provided credentials are incorrect']
            ]);
        }

        return $user->createToken( $request->device_name )->plainTextToken;

    }

    /**
     * logout a user and delete all their tokens
     * @param int $id
     * @return void
     */
    public function logout( int $id ): void
    {
        $user = User::find( $id );

        $user->tokens()->delete();

    }
}
