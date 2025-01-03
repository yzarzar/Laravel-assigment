<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->route('permission'),
            'guard_name' => 'sometimes|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Permission name is required',
            'name.unique' => 'Permission name already exists',
            'name.max' => 'Permission name cannot exceed 255 characters',
            'guard_name.max' => 'Guard name cannot exceed 255 characters'
        ];
    }
}
