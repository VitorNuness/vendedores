<?php

namespace Sellers\Authentication\Repositories;

use App\Models\User;
use Sellers\Authentication\DTO\UserDTO;

class UserRepository
{
    public function store(UserDTO $userDTO): UserDTO
    {
        $user = User::query()->create([
            "name"     => $userDTO->name,
            "email"    => $userDTO->email,
            "password" => $userDTO->password,
        ]);

        return UserDTO::fromModel($user);
    }

    public function updateName(int|string $id, string $name): UserDTO
    {
        $user = User::query()->findOrFail($id);
        $user->update([
            'name' => $name,
        ]);

        return UserDTO::fromModel($user);
    }
}
