<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\EmailTranslation;

class EmailRequest extends FormRequest
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
        $data = $request->all();
        return [
            'translation.*.title'    => ['required','max:150',function ($attribute, $value, $fail) use ($data){
                $name = explode(".",$attribute);
                $detail = [];
                if(isset($data['id'])){
                    $detail = EmailTranslation::where('id','!=',$data[$name[0]][$name[1]]['id'])->where('title',$value)->where('locale',$data[$name[0]][$name[1]]['locale'])->first();
                }else{
                    $detail = EmailTranslation::where('title',$value)->where('locale',$data[$name[0]][$name[1]]['locale'])->first();
                }
                if (!empty($detail) && isset($detail->id)){
					return $fail(__('The name has already been taken.'));
				}
            }],
            'translation.*.subject'    => 'required',
            'translation.*.description'    => 'required'
        ];
    }
}
