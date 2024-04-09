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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'password' =>  ['required', 'max:32'],
            'confirm-pass' => [
                'required',
                'min:8',
                'max:32',
                'same:password'
            ],
            'phone' => 'bail|numeric|min_digits:10|max_digits:11|regex:/^[0-9]+$/',
            'address' => ['required', 'max:255']
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
            'same' => __('messages.EM-CONFIRM'),
            'min_digits'        => __('messages.EM-MIN'),
            'max_digits'        => __('messages.EM-MAX'),
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
            'name' => __('label.user.name'),
            'email' => __('label.user.email'),
            'password' => __('label.user.password'),
            'confirm-pass' => __('label.user.confirm-pass'),
            'phone' => __('label.user.phone'),
            'address' => __('label.user.address'),
        ];
    }
}
