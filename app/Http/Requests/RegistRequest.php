<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function messags()
    {
        return [
            'name.required'=>'用户名不能为空',
            'name.unique'=>'用户名已经存在',
            'mobile.required'=>'手机号码不能为空',
            'mobile.unique'=>'手机号码格式不正确',
            'password.required'=>'密码不能为空',
            'password.unique'=>'密码为6-8位数',
            'password.confirmed'=>'密码不一致',
            'code.required'=>'验证码不能为空',
            'code.between'=>'验证码为6位数',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            
            'name' => 'required|min:2|max:18|unique:user',
            'mobile' => [
                    'required',
                    'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/',
                    'unique:user',
                ],
                    'password' => 'required|min:6|max:18|confirmed',
                    // 'password_confirmation' => 'required',
                // [
                //     'headimg' => 'required|image|max:2048',
                // ],
        ];
    }
} 
