<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\User;
use Auth;
use Hash;

class ForgotPasswordRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'email' => ['required', 'min:6','max:50', function ($attribute, $value, $fail) use ($request) {
                $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'number';
                $user = User::where($fieldType, $request->email)->first();
                if (empty($user)) {
                    return $fail(trans('validation.username_not_match'));
                }
            }],
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
