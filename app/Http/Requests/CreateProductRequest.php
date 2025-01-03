<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
            'price' => [
                'required',
                'numeric',
                'between:0,999999.99'
            ],
            'description' => [
                'required',
                'string',
                'max:2048'
            ],
            'image' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120'
            ],
            'status' => [
                'boolean'
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name cannot be longer than 255 characters.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'price.required' => 'The price is required.',
            'price.numeric' => 'The price must be a number.',
            'price.between' => 'The price must be between 0 and 999,999.99.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description cannot be longer than 2048 characters.',
            'image.required' => 'Please select an image for the product.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size cannot be larger than 5MB.',
            'status.boolean' => 'The status must be true or false.',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => $this->boolean('status'),
        ]);
    }
}
