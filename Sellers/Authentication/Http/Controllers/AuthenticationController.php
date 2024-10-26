<?php

namespace Sellers\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Sellers\Authentication\Actions\CreateUser;
use Sellers\Authentication\Http\Requests\CreateUserRequest;
use Sellers\Authentication\Http\Resources\TokenResource;

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
}
