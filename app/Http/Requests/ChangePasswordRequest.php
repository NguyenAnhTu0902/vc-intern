<?php

namespace App\Http\Requests;

use App\Rules\OldPasswordValidation;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password_old' => [
                'required',
                'max:32',
                new OldPasswordValidation()
            ],
            'password' =>  [
                'required',
                'required_with:password_confirm',
                'different:password_old',
                'max:32',
            ],
            'password_confirm' => ['required', 'same:password'],
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
            'password_old.required' => __('messages.EM-REQUIRED'),
            'password_old.max' => __('messages.EM-MAX'),
            'password.required' => __('messages.EM-REQUIRED'),
            'password.max' => __('messages.EM-MAX'),
            'password.different' => __('messages.EM-DIFF', ['attribute' => 'Mật khẩu mới']),
            'password_confirm.required' => __('messages.EM-REQUIRED'),
            'password_confirm.same' => __('messages.EM-SAME', ['attribute1' => 'Mật khẩu mới']),
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
            'password_old' => __('label.user.old_password'),
            'password' => __('label.user.new_password'),
            'password_confirm' => __('label.user.confirm-pass')
        ];
    }
}
