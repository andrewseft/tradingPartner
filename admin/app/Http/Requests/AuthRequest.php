<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        return ['email' => 'sometimes|required|email', 'password' => 'sometimes|required', 'captcha' => 'sometimes|required|captcha'];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('This is a required field'),
            'password.required' => __('This is a required field'),
            'captcha.captcha' => __('Captcha does not match'),
        ];
    }
}
