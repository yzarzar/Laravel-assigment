<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'sometimes|array',
            'permissions.*' => 'exists:permissions,name'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required',
            'name.unique' => 'Role name already exists',
            'permissions.array' => 'Permissions must be an array',
            'permissions.*.exists' => 'Selected permission does not exist'
        ];
    }
}
