<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name'=>'bail|required|unique:products|max:255|min:10',
            'price'=>'required',
            'cate'=>'required',
            'content1'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'name.unique' => 'Tên đã tồn tại',
            'name.max' => 'Tên ko đc phép quá 155 kí tự',
            'name.min' => 'Tên ko đc nhỏ hơn 10 kí tự',
            'price.required' => 'Chưa nhập giá',
            'category_id.required' => 'Chưa nhọn danh mục cho sản phẩm',
            'content1.required' => 'Chưa nhập nội dung'
        ];
    }
}
