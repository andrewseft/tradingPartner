<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Manager\CacheManager;
use App\Helpers\Helper;


class CheckOtpRequest extends FormRequest
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
        \Validator::extend('check', function($attribute, $value, $parameters) {
            $otp = CacheManager::get('otp');
            if ($otp != $value){
                return false;
            }
            return true;
        });
        return [
            'email' => 'required',
            'otp' => 'required|min:1|max:4|check',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator){
        Helper::__failedValidation($validator->errors()->first());
    }
}
