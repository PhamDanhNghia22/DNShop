<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Productrequest extends FormRequest
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
            'name_prod'=> 'bail|required|unique:products',
            'price'=> 'bail|required',
            'logo'=> 'bail|required|mimes:jpg,bmp,png,webp|file',
            'status'=> 'bail|required|int:0,1',
            'mota'=>'bail|required'
            
        ];
    }

    public function messages(){
        return [
            'name_prod.required'=>'Tên sản phẩm không được bỏ trống',
            'name_prod.unique'=>'Tên sản phẩm đã bị trùng',
            'price.required'=>'Giá không được bỏ trống',
            'logo.required'=>'Hình ảnh   không được bỏ trống',
            'logo.mimes'=>'Hình ảnh phải có đuôi file:jpg,bmp,png ',
            'status.required'=>'Trạng thái không được bỏ trống',
            'mota.required'=>'Mô tả không được bỏ trống',
        
        ];
    }
}
