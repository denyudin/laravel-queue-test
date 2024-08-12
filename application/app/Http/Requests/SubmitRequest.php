<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array{name: string, message: string, email: string}
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'message' => 'required|string',
            'email' => 'required|email|max:255',
        ];
    }
}
