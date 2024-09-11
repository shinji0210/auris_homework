<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MyProfilePostValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'content' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'name' => '名称',
            'content' => '投稿内容',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください。',
            'content.required' => '投稿内容を入力してください。',
        ];
    }
}
