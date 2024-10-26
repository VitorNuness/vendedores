<?php

namespace Sellers\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticableRequest extends FormRequest
{
    public function authenticate(): string|bool
    {
        $credentials = [
            'email'    => $this->input('email'),
            'password' => $this->input('password'),
        ];

        return auth()->attempt($credentials);
    }
}
