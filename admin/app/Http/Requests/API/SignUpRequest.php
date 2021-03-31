<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\User;

class SignUpRequest extends FormRequest
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
            'name' => 'required|min:1|max:15',
            'investmentCapital' => 'required|min:1|max:15',
            'password' => 'required|string|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|min:6|max:50',
            'number'    => ['required',Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at')],
            'email'    => ['required',Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at'),'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'referral_code'    => ["sometimes",function ($attribute, $value, $fail){
                $detail = User::where('referral_code',$value)->first();
                if ($value != "" && empty($detail)){
					return $fail(__('Please enter valid referral code'));
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
