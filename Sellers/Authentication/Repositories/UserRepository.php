<?php

namespace Sellers\Authentication\Repositories;

use App\Models\User;
use Sellers\Authentication\DTO\UserDTO;

class UserRepository
{
    public function store(UserDTO $userDTO): User
    {
        return User::query()->create([
            "name"     => $userDTO->name,
            "email"    => $userDTO->email,
            "password" => $userDTO->password,
        ]);
    }
}
