<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'category_id' => ['required'],
            'price' => ['bail', 'required', 'numeric', 'digits_between:1,10', 'regex:/^[0-9]+$/'],
            'image' => ['image', 'max:2 * 1024'],
            'description' => ['max: 255']
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'regex' => __('messages.EM-REGEX'),
            'digits_between' => __('messages.MAX'),
            'required' => __('messages.EM-REQUIRED'),
            'max' => __('messages.EM-MAX'),
            'integer' => __('messages.EM-REGEX'),
            'image' => __('messages.EM-REGEX')
        ];
    }

    /**
     * Get the validation attribute.
     *
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'name' => __('label.product.name'),
            'category_id' => __('label.product.category_id'),
            'price' => __('label.product.price'),
            'image' => __('label.product.image'),
            'description' => __('label.product.description'),
        ];
    }
}
