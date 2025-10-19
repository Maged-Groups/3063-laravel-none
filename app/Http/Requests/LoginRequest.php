<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // After 6 PM not allowed to login
        // otherwise, you may login

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => "required|email",
            'password' => "required|between:8,20",
            'remember' => 'nullable|boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'لابد من كتابة البريد الإلكتروني',
            'email.exists' => 'email.not-exists'
        ];
    }
}
