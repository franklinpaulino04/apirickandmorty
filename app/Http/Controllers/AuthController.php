<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\AuthRepository;
use Exception;
use Illuminate\Http\Request;

class AuthController extends AppBaseController
{
    private $authRepository;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepository = $authRepo;
    }

    public function login(LoginRequest $request)
    {
        try {
            $fields = $request->only('email', 'password');
            $result = $this->authRepository->login($fields);
            return $this->sendSuccess('', $result);

        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], $e->getCode());
        }
    }

    public function show(Request $request)
    {
        try {
            $result = $this->authRepository->show($request);
            return $this->sendSuccess('', $result);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return $this->sendSuccess('user is logout!');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }
}
