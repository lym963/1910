<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
            'brand_name' => 'bail|required|unique:brand|max:20',
            'brand_url' => 'bail|required|unique:brand|max:50', 
        ];
    }
    public function messages(){
        return [
            "brand_name.required"=>"品牌名称不可为空",
            "brand_name.unique"=>"品牌名称已存在",
            "brand_name.max"=>"品牌名称最大为20",
            "brand_url.required"=>"品牌网址不可为空",
            "brand_url.unique"=>"品牌网址已存在",
            "brand_url.max"=>"品牌网址最大为50",
        ];
    }
}
