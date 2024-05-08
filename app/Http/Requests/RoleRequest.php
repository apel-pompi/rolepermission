<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'permission' => ['required','array']
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => 'Name field is required',
            'permission.required' => 'Permission field is required',
            'permission.array' => 'Permission Array field is required',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name Role',
            'permission' => 'Permission Role',
        ];
    }
}
