<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateLanguageRequest extends FormRequest
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
            'lang' => ['required', 'string', 'unique:languages,lang'],
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'default' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
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
            'lang.required' => 'Vui lòng nhập mã ngôn ngữ.',
            'lang.unique' => 'Mã ngôn ngữ đã tồn tại.',
            'name.required' => 'Tên ngôn ngữ là bắt buộc.',
            'slug.required' => 'Slug là bắt buộc.',
            'default.required' => 'Trạng thái mặc định là bắt buộc.',
            'status.required' => 'Trạng thái là bắt buộc.',
        ];
    }
}