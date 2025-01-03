<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('id'),
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'sometimes|exists:roles,name',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already taken',
            'password.min' => 'Password must be at least 8 characters',
            'password.confirmed' => 'Password confirmation does not match',
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif',
            'image.max' => 'The image may not be greater than 2MB',
            'role.exists' => 'The selected role is invalid',
            'address.required' => 'Address is required',
            'address.max' => 'Address cannot exceed 500 characters',
            'phone.required' => 'Phone number is required',
            'phone.max' => 'Phone number cannot exceed 20 characters',
            'phone.regex' => 'Please enter a valid phone number'
        ];
    }
}
