<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilerequest extends FormRequest
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
            "name"=>'required|min:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
     public function messages(){
        return [
            'name.required'=>':attribute bắt buộc phải nhập',
            
            'avatar.image' => 'Avatar phải là một hình ảnh.',
            'avatar.mimes' => 'Định dạng hình ảnh không hợp lệ.',
            'avatar.max' => 'Kích thước hình ảnh không được vượt quá 1MB.',
        ];
    }
    public function attributes(){
        return [
            'name'=>"Tên",
            
        ];
    }
}
