<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LanguageRequest extends FormRequest
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
            'name'    => 'required|unique:languages,id,'.$request->get('id'),
            'description' => 'required',
            'code' => 'required|unique:languages,id,'.$request->get('id')];
    }

    /**
     * Custom message for validation
     * @return array
     */
    public function messages(){
        return [
            'name.required' => __('This is a required field'),
            'name.unique' => __('The name has already been taken.'),
            'code.required' => __('This is a required field'),
            'code.unique' => __('The code has already been taken.'),
            'description.required' => __('This is a required field')
        ];
    }
}
