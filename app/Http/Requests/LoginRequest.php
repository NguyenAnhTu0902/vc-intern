<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns', 'max:255'],
            'password' =>  ['required', 'max:32'],
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
            'email.required' => __('messages.EM-REQUIRED'),
            'email.max' => __('messages.EM-MAX'),
            'email.email' => __('messages.EM-EMAIL'),
            'password.required' => __('messages.EM-REQUIRED'),
            'password.min' => __('messages.EM-MIN'),
            'password.max' => __('messages.EM-MAX')
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
            'email' => __('label.user.email'),
            'password' => __('label.user.password')
        ];
    }
}
