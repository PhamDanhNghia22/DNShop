<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_cate'=> 'bail|required|unique:category'
        ];
    }
    public function messages(){
        return[
            'name_cate.required'=>'Tên thể loại không được bỏ trống',
            'name_cate.unique'=>'Tên thể loại đã bị trùng',
        ];

    }
}
