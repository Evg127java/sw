<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends RegisterController
{
    use AuthenticatesUsers;

    /**
     * Registers API users
     *
     * @param Request $request
     * @return Application|ResponseFactory|JsonResponse|RedirectResponse|Response
     * @throws ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        $token = $user->createToken('SWToken')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];

        return response($response, 201);
    }

    /**
     * Logs in API users
     *
     * @param Request $request
     * @return Application|ResponseFactory|Response
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        /* Default success http code */
        $httpCode = 201;

        $this->validateLogin($request);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            $response = ['message' => 'Wrong credential data'];
            $httpCode = 401;
        }

        $token = $user->createToken('SWToken')->plainTextToken;
        $response = ['user' => $user, 'token' => $token];

        return response($response, $httpCode);
    }

    /**
     * Logs out API users
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
    }
}
