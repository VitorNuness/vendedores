<?php

namespace Sellers\Authentication\Http\Requests;

use Sellers\Authentication\DTO\UserDTO;

class CreateUserRequest extends AuthenticableRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ];
    }

    public function toDTO(): UserDTO
    {
        return new UserDTO(
            $this->input("name"),
            $this->input("email"),
            $this->input("password")
        );
    }
}
