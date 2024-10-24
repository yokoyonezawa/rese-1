<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReseRequest extends FormRequest
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
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i', // 時間フォーマットを確認
            'number' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
        'name.required' => '名前を入力してください',

    ];
}
}
