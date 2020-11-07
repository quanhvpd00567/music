<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'                  => 'required|max:100',
            'phone'                 => 'max:20|regex:/^[0-9]/i',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|max:255|min:8',
            'password_confirm'      => 'required|same:password|max:255|min:8'
        ];
    }

    public function attributes()
    {
       return [
           'name'               => 'Họ và tên',
           'phone'              => 'Số điện thoại',
           'email'              => 'Email',
           'password'           => 'Mật khẩu',
           'password_confirm'   => 'Xác nhận mật khẩu'
       ];
    }

    public function messages()
    {
        return [
            'name.required'                         => ':attribute không để trống',
            'email.required'                        => ':attribute không để trống',
            'password.required'                     => ':attribute không để trống',
            'password_confirm.required'             => ':attribute không để trống',
            'name.max'                              => ':attribute không quá :max ký tự',
            'email.max'                             => ':attribute không quá :max ký tự',
            'password.max'                          => ':attribute không quá :max ký tự',
            'phone.max'                             => ':attribute không quá :max ký tự',
            'password_confirm.max'                  => ':attribute không quá :max ký tự',
            'email.unique'                          => ':attribute đã tồn tại',
            'password_confirm.same'                 => ':attribute không giống nhau',
            'phone.regex'                           => ':attribute phải là số',
        ];
    }
}
