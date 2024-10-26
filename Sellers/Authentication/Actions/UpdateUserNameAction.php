<?php

namespace Sellers\Authentication\Actions;

use Sellers\Authentication\DTO\UserDTO;
use Sellers\Authentication\Repositories\UserRepository;

class UpdateUserNameAction
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function handle(string $name): UserDTO
    {
        $id = auth()->user()->id;

        return $this->userRepository->updateName($id, $name);
    }
}
