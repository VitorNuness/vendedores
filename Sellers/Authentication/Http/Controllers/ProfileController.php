<?php

namespace Sellers\Authentication\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Sellers\Authentication\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        return response()->json(new ProfileResource($user));
    }
}
