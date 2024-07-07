<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'language' => 'required',
            'name' => 'required',
            'show_at_nav' => 'required',
            'status' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'language.required' => 'Chọn 1 ngôn ngữ',
            'name.required' => 'Tên danh mục không được để trống',
            'show_at_nav.required' => 'Trạng thái hiển thị ở thanh nav không được để trống',
            'status.required' => 'Trạng thái không được để trống',
        ];
    }
}