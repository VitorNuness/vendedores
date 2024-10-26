<?php

namespace Sellers\Authentication\Actions;

use Sellers\Authentication\DTO\UserDTO;
use Sellers\Authentication\Repositories\UserRepository;

class CreateUser
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function handle(UserDTO $userDTO): void
    {
        $this->userRepository->store($userDTO);
    }
}
