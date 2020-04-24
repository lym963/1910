<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryPost extends FormRequest
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
            'cate_name' => 'bail|required|unique:cate|max:20', 
        ];
    }
    public function messages()
    { 
        return [ 
            "cate_name.required"=>"分类名称不可为空",
            "cate_name.unique"=>"分类名称已存在",
            "cate_name.max"=>"分类名称最大为20",
        ]; 
    }
}
