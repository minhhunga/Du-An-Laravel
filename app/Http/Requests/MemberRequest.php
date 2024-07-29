<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|min:5',
            'email'=>'required|email',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:5',
            'phone'=>'required|min:5',
             
        ];
    }
    public function messages(){
        return[
            'name.required'=>':attribute bắt buộc phải nhập',
            'email.required'=>':attribute bắt buộc phải nhập',
            'password.required'=>':attribute bắt buộc phải nhập',
            'phone.required'=>':attribute bắt buộc phải nhập',

        ];
    }
    public function attributes(){
        return [
            'name'=>'Tên',
            'email'=>'Email',
            'password'=>'Mật khẩu',
            'phone'=>'Số điện thoại'
        ];
    }
}
