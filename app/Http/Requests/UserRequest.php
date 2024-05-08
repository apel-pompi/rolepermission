<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'roles' => ['required','array'],
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => 'Name field is required',
            'email.required' => 'Email field is required',
            'password' => 'Password Array field is required',
            'roles' => 'Roles field is required',
            'roles.array' => 'Roles Array field is required',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name User',
            'email' => 'Email User',
            'password' => 'Password User',
            'roles' => 'Roles User',
        ];
    }
}
