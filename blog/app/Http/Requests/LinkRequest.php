<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LinkRequest extends Request
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
            'name'=>'required',
            'url'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'链接名称不能为空',
            'url.required'=>'链接地址不能为空',
        ];
    }
}
