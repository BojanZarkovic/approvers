<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => ['required', 'integer'],
            'employee_type' => ['required', 'string', Rule::in(['professor', 'trader']),],
            'date' => ['required', 'date_format:"d/m/Y"|after_or_equal:today'],
            'hours' => ['required', 'numeric', 'max:24'],
        ];
    }
}
