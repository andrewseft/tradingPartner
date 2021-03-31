<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'email' => ['sometimes','max:50','required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at')],
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'current_password' => ['sometimes', 'required', 'min:6', function ($attribute, $value, $fail) use ($request) {
                $user = User::where('id', $request->id)->first();
                if ($request->get('current_password')) {
                    if (!Hash::check($request->current_password, $user->password)) {
                        return $fail(trans('passwords.current_password'));
                    }
                }
            }],
            'password' => 'sometimes|required|min:6|confirmed',
            'password_confirmation' => 'sometimes|required|min:6',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'number'    => ['sometimes','required',Rule::unique('users')->ignore($request->get('id'))->whereNull('deleted_at')],
            'user_name'    => "sometimes|required|unique:users,user_name,{$request->get('id')},id,deleted_at,NULL",
            'address'    => "sometimes|required",
            'profile.user_name'    => "sometimes|required",
            'profile.dob'    => "sometimes|required",
            'profile.driver_licence_no'    => "sometimes|required",
            'profile.vehicle_type'    => "sometimes|required",
            'profile.make_id'    => "sometimes|required",
            'profile.model'    => "sometimes|required",
            'profile.job_area'    => "sometimes|required",
            'profile.vehicle_registration_no'    => "sometimes|required",
            'profile.year'    => "sometimes|required",
            'profile.vehicle_registration_date'    => "sometimes|required",
            'profile.account_no'    => "sometimes|required",
        ];

    }


}
