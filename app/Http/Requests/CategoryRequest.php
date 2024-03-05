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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     =>  'required|min:1|max:30',
            'parent_id' =>  'required',
            'order'     =>  'required|integer',
            // 'icon'      =>  'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'        =>  '分类名称必须填写',
            'title.min'             =>  '分类名最小不少于1',
            'title.max'             =>  '分类名最大不超过30',
            'parent_id.required'    =>  '上级分类不能为空',
            'order.required'        =>  '排序不能为空',
            'order.integer'          =>  '排序只能是数字',
            'icon.required'         =>  '图标不能为空',
        ];
    }
}
