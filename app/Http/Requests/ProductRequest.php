<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=>'required',
            'price'=>'required',
            'category'=>'required',
            'brand'=>'required',

        ];
    }
    public function messages(){
        return [
            'name.required'=>' vui lòng nhập tên sản phẩm',
            'price.required'=>'vui lòng nhập giá sản phẩm',
            'category.required'=>' vui lòng chọn category',
            'brand.required'=>' vui lòng chọn hãng brand',
        ];
    }

}
