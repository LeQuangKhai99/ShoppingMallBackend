<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingCreateRequest extends FormRequest
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
            'key'=>'bail|required|unique:settings,config_key',
            'value'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'key.required'=>'Chưa nhập config key',
            'value.required'=>'Chưa nhập config value',
            'key.unique'=>'Key đã tồn tại'
        ];
    }
}
