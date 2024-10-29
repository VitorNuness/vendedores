<?php

namespace Sellers\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Response};
use Sellers\Authentication\Actions\{DestroyUserAction, UpdateUserNameAction};
use Sellers\Authentication\DTO\UserDTO;
use Sellers\Authentication\Http\Requests\UpdateProfileRequest;
use Sellers\Authentication\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function __construct(
        private readonly UpdateUserNameAction $updateUserNameAction,
        private readonly DestroyUserAction $destroyUserAction
    ) {
    }

    public function show(): JsonResponse
    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        return response()->json(new ProfileResource(UserDTO::fromModel($user)));
    }

    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->updateUserNameAction->handle($request->getName());

        return response()->json(new ProfileResource($user));
    }

    public function destroy(): Response
    {
        $this->destroyUserAction->handle();

        return response()->noContent();
    }
}
