<?php

namespace Sellers\Authentication\Actions;

use Sellers\Authentication\Repositories\UserRepository;

class DestroyUserAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function handle(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $this->userRepository->destroy($user->id);
    }
}
