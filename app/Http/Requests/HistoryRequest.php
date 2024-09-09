<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true; // ユーザーが認証されていることを確認する場合は、ここで認証ロジックを実装
    }

    public function rules()
    {
        return [
            'phone_number' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'self_pr' => 'nullable|string',
            'academic_status' => 'required|string',
            'faculty' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'phone_number.required' => '電話番号は必須です。',
            'phone_number.max' => '電話番号は15文字以内で入力してください。',
            'birth_date.required' => '生年月日は必須です。',
            'birth_date.date' => '有効な日付を入力してください。',
            'graduation_month.between' => '卒業月は1から12の間で入力してください。',
        ];
    }
}