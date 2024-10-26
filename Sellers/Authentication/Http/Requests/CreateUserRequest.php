<?php

namespace Sellers\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sellers\Authentication\DTO\UserDTO;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name"     => ["required", "string"],
            "email"    => ["required", "email", "unique:users,email"],
            "password" => ["required", "string"],
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

    public function authenticate(): string
    {
        $credentials = [
            'email'    => $this->input('email'),
            'password' => $this->input('password'),
        ];

        return auth()->attempt($credentials);
    }
}
