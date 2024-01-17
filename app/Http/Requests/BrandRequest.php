<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_brand'=> 'bail|required|unique:brand',
            'logo'=> 'required|mimes:jpg,bmp,png|file'
        ];
    }
    public function messages(){
        return[
            'name_brand.required'=>'Tên thương hiệu không được trống',
            'name_brand.unique'=>'Tên thương hiệu đã bị trùng',
            'logo.required'=>'Hình ảnh không được trống'
        ];
    }
}
