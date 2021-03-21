<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;


class BannerRequest extends FormRequest
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
            'layout_place'    => 'sometimes|required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'hyperlink'    => 'sometimes|required|max:150',
            'start_date_time'    => 'sometimes|required',
            'end_date_time'    => 'sometimes|required',
            'translation.*.description'    => 'sometimes|required'
        ];
    }
}
