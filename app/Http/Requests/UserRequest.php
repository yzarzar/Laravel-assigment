<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

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
        $userId = $this->route('id');
        $roles = Role::pluck('name')->toArray();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
            'roles' => ['nullable', Rule::in($roles)],
        ];

        // Only require password for new users
        if (!$userId) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $rules;
    }
}
