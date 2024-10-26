<?php

namespace Sellers\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Sellers\Authentication\Actions\CreateUser;
use Sellers\Authentication\Http\Requests\{CreateUserRequest, CredentialsRequest};
use Sellers\Authentication\Http\Resources\TokenResource;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function __construct(
        private readonly CreateUser $createUser
    ) {

    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $credentials = $request->toDTO();
        $this->createUser->handle($credentials);
        $token = $request->authenticate();

        return response()->json(new TokenResource($token));
    }

    public function login(CredentialsRequest $request): JsonResponse
    {
        if (!$token = $request->authenticate()) {
            return response()->json([], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(new TokenResource($token));
    }
}
