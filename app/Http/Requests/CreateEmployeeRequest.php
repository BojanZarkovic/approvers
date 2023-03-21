<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'unique:users', 'email', 'max:255'],
            'employee_type' => ['required', 'string', Rule::in(['professor', 'trader']),],
            'password' => ['required', 'string', 'min:6'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'hours' => ['required', 'numeric', 'max:24'],
            'payroll_per_hour' => ['required', 'numeric', 'max:1000000'],
        ];
    }
}
