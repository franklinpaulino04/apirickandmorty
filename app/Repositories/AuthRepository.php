<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AuthRepository extends BaseRepository
{
    public function getFieldsSearchable()
    {
        return [];
    }

    public function model()
    {
        return User::class;
    }

    public function login($fields)
    {
        try {

            $user = User::where('email', $fields['email'])->first();

            if (!$user)
            {
                throw new \Exception('Invalid credentials',401);
            }

            if (!Hash::check($fields['password'], $user->password))
            {
                throw new \Exception('Invalid credentials',401);
            }

            $token = $user->createToken('authToken')->plainTextToken;

            return [
                'token' => $token,
                'user'  => $user,
            ];

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function show($request)
    {
        try {
            return $request->user()->toArray();
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
