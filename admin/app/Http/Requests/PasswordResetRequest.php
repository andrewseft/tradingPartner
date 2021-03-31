<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'    => 'sometimes|required|email|exists:users',
            'password' => 'sometimes|required|min:6|confirmed',
            'password_confirmation' => 'sometimes|required|min:6',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
                'email.required' => __('The email field is required.'),
                'email.email' => __('The email must be a valid email address.'),
                'email.exists' => __('That email address is not registered'),
                'password.required' => __('This is a required field'),
                'password.regex' => __('Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.'),
                'password.min' => __('The input value is shorter than 6 characters'),
                'password.confirmed' => __('Password and confirm password not match'),
                'password_confirmation.required' => __('This is a required field'),
                'password_confirmation.min' => __('The input value is shorter than 6 characters'),
        ];
    }
}
