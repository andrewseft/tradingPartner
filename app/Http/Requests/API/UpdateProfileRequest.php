<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Auth;

class UpdateProfileRequest extends FormRequest
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
        $user = Auth::user();
        return [
            'name' => 'required|min:1|max:15',
            'bank_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'adahr_card_number' => 'required',
            'pan_cart_number' => 'required',
            'email' => ['max:50','required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', Rule::unique('users')->ignore($user->id)->whereNull('deleted_at')],
            'number'    => ['required',Rule::unique('users')->ignore($user->id)->whereNull('deleted_at')],
            'adahr_card_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'pan_cart_image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'image' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif|max:1024',
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
