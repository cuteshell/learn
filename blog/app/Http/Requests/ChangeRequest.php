<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ChangeRequest extends Request
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
            'password_o' => 'required',
            'password' => 'required|between:6,20|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'password_o.required' => '旧密码不能为空！',
            'password.required' => '新密码不能为空！',
            'password.between' => '新密码必须6-20位!',
            'password.confirmed' => '新密码和确认密码不匹配！'
        ];
    }
}
