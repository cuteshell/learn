<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddCateRequest extends Request
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
            'cate_name'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'cate_name.required'=>'分类名称不能为空！'
        ];
    }
}
