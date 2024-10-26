<?php

namespace Sellers\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
        ];
    }

    public function getName(): string
    {
        return $this->input('name');
    }
}
