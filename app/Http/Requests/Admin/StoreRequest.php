<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'secondary_category_id' => 'required|exists:secondary_categories,id',
            'location1' => 'required|string|max:255',
            'location2' => 'nullable|string|max:255',
            'location3' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'salary_type' => 'required|string|max:255',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer|gte:min_salary',
            'deadline' => 'required|date',
            'work_days_min' => 'nullable|integer|min:1|max:7',
            'work_days_max' => 'nullable|integer|min:1|max:7|gte:work_days_min',
            'work_hours_start' => 'nullable|date_format:H:i',
            'work_hours_end' => 'nullable|date_format:H:i|after:work_hours_start',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '求人タイトルを入力してください',
            'description.required' => '求人詳細を入力してください',
            'title.max' => '求人タイトルは255文字以内で入力してください',
            'description.required' => '求人詳細を入力してください',
            'secondary_category_id.required' => '職種を選択してください',
            'secondary_category_id.exists' => '選択された職種は存在しません',
            'location1.required' => '勤務地1を選択してください',
            'location1.max' => '勤務地1は255文字以内で入力してください',
            'location2.max' => '勤務地2は255文字以内で入力してください',
            'location3.max' => '勤務地3は255文字以内で入力してください',
            'type.required' => '雇用形態を選択してください',
            'type.max' => '雇用形態は255文字以内で入力してください',
            'salary_type.required' => '給与タイプを選択してください',
            'salary_type.max' => '給与タイプは255文字以内で入力してください',
            'min_salary.required' => '最小給与を入力してください',
            'min_salary.integer' => '最小給与は整数で入力してください',
            'max_salary.required' => '最大給与を入力してください',
            'max_salary.integer' => '最大給与は整数で入力してください',
            'max_salary.gte' => '最大給与は最小給与以上の値を入力してください',
            'deadline.required' => '応募締切を入力してください',
            'deadline.date' => '応募締切は日付形式で入力してください',
            'work_days_min.integer' => '最小勤務日数は整数で入力してください',
            'work_days_min.min' => '最小勤務日数は1以上7以下の値を入力してください',
            'work_days_max.integer' => '最大勤務日数は整数で入力してください',
            'work_days_max.min' => '最大勤務日数は1以上7以下の値を入力してください',
            'work_days_max.gte' => '最大勤務日数は最小勤務日数以上の値を入力してください',
            'work_hours_start.date_format' => '勤務時間開始は時間形式(HH:mm)で入力してください',
            'work_hours_end.date_format' => '勤務時間終了は時間形式(HH:mm)で入力してください',
            'work_hours_end.after' => '勤務時間終了は勤務時間開始よりも後の時刻を入力してください',
            'image.image' => '画像ファイルを選択してください',
            'image.mimes' => '画像ファイルはjpeg、png、jpg、gifのいずれかのファイル形式である必要があります',
            'image.max' => '画像ファイルのサイズは2MB以下である必要があります',
        ];
    }
}
