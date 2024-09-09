<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求人登録</title>
    <link rel="stylesheet" href="/css/adminjob.css">
</head>
<body>
    <main>
        <form action="{{ route('admin.adminjob.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            {{-- バリデーションエラー表示 --}}
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="from_wrapper">
                <div class="form_block">
                    <label for="title">求人タイトル</label><br>
                    <input type="text" name="title" id="title" class="form_title" value="{{ old('title') }}">
                </div>
                <div class="form_block">
                    <label for="description">求人詳細</label><br>
                    <textarea name="description" id="description" class="form_description">{{ old('description') }}</textarea>
                </div>
                <div class="form_flex">
                    <div class="salary_flex">
                        <div class="salary_margin">
                            <label for="salary_type">給与タイプ</label><br>
                            <select name="salary_type" id="salary_type" class="form_salary"  onchange="updateSalaryOptions()">
                                <option value="">選択してください</option>
                                <option value="時給" {{ old('salary_type') == '時給' ? 'selected' : '' }}>時給</option>
                                <option value="日給" {{ old('salary_type') == '日給' ? 'selected' : '' }}>日給</option>
                                <option value="月給" {{ old('salary_type') == '月給' ? 'selected' : '' }}>月給</option>
                            </select>
                        </div>
                        <div class="salary_margin">
                            <label for="min_salary">最小給与</label><br>
                            <select name="min_salary" id="min_salary" class="min_salary">
                                <option value="">選択してください</option>
                            </select>
                        </div>
                        <div class="salary_margin">
                            <label for="max_salary">最大給与</label><br>
                            <select name="max_salary" id="max_salary" class="max_salary">
                                <option value="">選択してください</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="type">雇用形態</label><br>
                        <select name="type" id="type" class="form-type">
                            <option value="パート・アルバイト">パート・アルバイト</option>
                            <option value="派遣">派遣</option>
                            <option value="契約社員">契約社員</option>
                            <option value="正社員">正社員</option>
                            <option value="委託・請負">委託・請負</option>
                            <option value="フランチャイズ">フランチャイズ</option>
                        </select>
                    </div>
                </div>
                <div class="form_block">
                    <label for="category" class="category">職種</label><br>
                    <select name="secondary_category_id" id="category" class="form_category">
                        <option value="" selected disabled>職種を選択してください</option>
                        @foreach($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach($category->secondary as $secondary)
                            <option value="{{ $secondary->id }}" {{ old('secondary_category_id') == $secondary->id ? 'selected' : '' }}>
                                {{ $secondary->name }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="form_flex">
                    <label for="location1">勤務地</label><br>
                    <select name="location1" id="location1" class="form_location">
                        <option value="">選択してください</option>
                        @foreach($prefectures as $key => $prefecture)
                            <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                        @endforeach
                    </select>
                    <div class="form_group">
                        <label for="location2">勤務地2（任意）</label><br>
                        <select name="location2" id="location2" class="form_location">
                            <option value="">選択してください</option>
                            @foreach($prefectures as $key => $prefecture)
                                <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="location3">勤務地3（任意）</label><br>
                        <select name="location3" id="location3" class="form_location">
                            <option value="">選択してください</option>
                            @foreach($prefectures as $key => $prefecture)
                                <option value="{{ $prefecture }}">{{ $prefecture }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="deadline">応募締切</label><br>
                        <input type="date" name="deadline" id="deadline" class="form_deadline">
                    </div>
                </div>
                <div class="form_flex">
                    <div class="form_group">
                        <label for="work_days">勤務日数</label><br>
                        <div class="flex items-center">
                            週 <input type="number" name="work_days_min" id="work_days_min" min="1" max="7" class="form-control mx-2" style="width: 60px;"> 日
                            ～
                            週 <input type="number" name="work_days_max" id="work_days_max" min="1" max="7" class="form-control mx-2" style="width: 60px;"> 日
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="work_hours">勤務時間</label><br>
                        <div class="flex items-center">
                            <select name="work_hours_start" id="work_hours_start" class="form-control">
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                @endfor
                            </select>
                            ～
                            <select name="work_hours_end" id="work_hours_end" class="form-control">
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ sprintf('%02d:00', $i) }}">{{ sprintf('%02d:00', $i) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form_block">
                    <label for="image">画像</label><br>
                    <input type="file" class="form_image" id="image" name="image">
                </div>
                <div class="form_flex">
                    <a href="{{ route('admin.adminjob.index') }}" class="btn-primary">戻る</a>
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </div>
        </form>
    </main>
    <script src="/js/adminjob.js"></script>
</body>
</html>