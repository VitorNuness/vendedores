<?php

namespace Sellers\Authentication\DTO;

use App\Models\User;
use Sellers\Authentication\Http\Requests\CreateUserRequest;

readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password,
        public ?int $id = null,
        public ?string $created_at = null,
        public ?string $updated_at = null,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            $user->name,
            $user->email,
            $user->password,
            $user->id,
            $user->created_at->toDateTimeString(),
            $user->updated_at->toDateTimeString()
        );
    }

    public static function fromRequest(CreateUserRequest $request): self
    {
        return new self(
            $request->input("name"),
            $request->input("email"),
            $request->input("password")
        );
    }
}
