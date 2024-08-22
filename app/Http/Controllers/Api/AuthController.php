<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\AuthAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthRequest;
use App\Http\Resources\Api\User\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(
        AuthRequest $request,
        AuthAction $user
    ) {
        return UserResource::make($user())->additional(['access_token' => $user()->token]);
    }

    public function logout(
        Request $request
    ) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function getSession(
        Request $request
    ): JsonResponse
    {
        if ($request->user()) {
            return response()->json(['valid' => true]);
        }
        return response()->json(['valid' => false], ResponseAlias::HTTP_UNAUTHORIZED);
    }

    public function getUser(
        Request $request
    ){
        return UserResource::make(
            User::find(\auth()->id())
        );
    }
}
