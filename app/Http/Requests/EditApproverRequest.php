<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditApproverRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['sometimes', 'string', 'unique:users', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:6'],
            'first_name' => ['sometimes', 'string', 'max:255'],
            'last_name' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
