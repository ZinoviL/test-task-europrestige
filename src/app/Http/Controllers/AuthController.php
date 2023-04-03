<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        if (!Auth::validate($requestData)) {
            return new JsonResponse(['message' => '', 'errors' => ['password' => __('auth.failed')]], 422);
        }

        /** @var User $user */
        $user = User::query()->where('email', $requestData['email'])->first();

        $token = $user->createToken('main');

        return new JsonResponse(['token' => $token->plainTextToken], 200);

    }
}
