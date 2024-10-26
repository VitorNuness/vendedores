<?php

namespace Sellers\Authentication\Http\Requests;

class CredentialsRequest extends AuthenticableRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }
}
