<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                'name'    => 'required|max:50|sometimes',
                'email'    => ['sometimes','required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix','max:50'],
                'support_email'    => ['required','regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix','max:50','sometimes'],
                'number'    => 'required|sometimes|max:50|regex:/[0-9]{9}/',
                'address'    => 'required|max:200|sometimes',
                'copy_right'    => 'required|max:150|sometimes',
                'admin_limit'    => 'required|max:5|sometimes',
                'front_limit'    => 'required|max:5|sometimes',
                'platform_commission'   => 'required|sometimes|numeric',
                'driver_commission'   => 'required|sometimes|numeric',
                'two_wheeler_wash'   => 'required|sometimes|numeric',
                'radius'   => 'required|sometimes|numeric'
        ];
    }
}
