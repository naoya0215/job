<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求人編集</title>
    <link rel="stylesheet" href="/css/adminjob.css">
</head>
<body>
    <main>
        <form action="{{ route('admin.adminjob.update', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <label for="switch" class="switch_label">
                <div class="switch">
                    <input type="checkbox" id="switch" name="is_active" {{ $job->is_active ? 'checked' : '' }} />
                    <div class="circle"></div>
                    <div class="base"></div>
                </div>
                <span class="title">公開</span>
            </label>
            <div class="from_wrapper">
                <div class="form_block">
                    <label for="title">求人タイトル</label><br>
                    <input type="text" name="title" id="title" class="form_title" value="{{ old('title', $job->title) }}">
                </div>
                <div class="form_block">
                    <label for="description">求人詳細</label><br>
                    <textarea name="description" id="description" class="form_description">{{ old('description', $job->description) }}</textarea>
                </div>
                <div class="form_flex">
                    <div class="salary_flex">
                        <div class="salary_margin">
                            <label for="salary_type">給与タイプ</label><br>
                            <select name="salary_type" id="salary_type" class="form_salary" onchange="updateSalaryOptions()">
                                <option value="">選択してください</option>
                                <option value="時給" {{ old('salary_type', $job->salary_type) == '時給' ? 'selected' : '' }}>時給</option>
                                <option value="日給" {{ old('salary_type', $job->salary_type) == '日給' ? 'selected' : '' }}>日給</option>
                                <option value="月給" {{ old('salary_type', $job->salary_type) == '月給' ? 'selected' : '' }}>月給</option>
                            </select>
                        </div>
                        <div class="salary_margin">
                            <label for="min_salary">最小給与</label><br>
                            <select name="min_salary" id="min_salary" class="min_salary" data-value="{{ old('min_salary', $job->min_salary) }}">
                                <option value="">選択してください</option>
                                <!-- JavaScriptで動的に選択肢を生成 -->
                            </select>
                        </div>
                        <div class="salary_margin">
                            <label for="max_salary">最大給与</label><br>
                            <select name="max_salary" id="max_salary" class="max_salary" data-value="{{ old('max_salary', $job->max_salary) }}">
                                <option value="">選択してください</option>
                                <!-- JavaScriptで動的に選択肢を生成 -->
                            </select>
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="type">雇用形態</label><br>
                        <select name="type" id="type" class="form-type">
                            <option value="パート・アルバイト" {{ old('type', $job->type) == 'パート・アルバイト' ? 'selected' : '' }}>パート・アルバイト</option>
                            <option value="派遣" {{ old('type', $job->type) == '派遣' ? 'selected' : '' }}>派遣</option>
                            <option value="契約社員" {{ old('type', $job->type) == '契約社員' ? 'selected' : '' }}>契約社員</option>
                            <option value="正社員" {{ old('type', $job->type) == '正社員' ? 'selected' : '' }}>正社員</option>
                            <option value="委託・請負" {{ old('type', $job->type) == '委託・請負' ? 'selected' : '' }}>委託・請負</option>
                            <option value="フランチャイズ" {{ old('type', $job->type) == 'フランチャイズ' ? 'selected' : '' }}>フランチャイズ</option>
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
                            <option value="{{ $secondary->id }}" {{ old('secondary_category_id', $job->secondary_category_id) == $secondary->id ? 'selected' : '' }}>
                                {{ $secondary->name }}
                            </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="form_flex">
                    <label for="location1">勤務地</label><br>
                    <select name="location1" id="location1" class="form_location" required>
                        <option value="">選択してください</option>
                        @foreach($prefectures as $key => $prefecture)
                            <option value="{{ $prefecture }}" {{ old('location1', $job->location1) == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                        @endforeach
                    </select>
                    <div class="form_group">
                        <label for="location2">勤務地2（任意）</label><br>
                        <select name="location2" id="location2" class="form_location">
                            <option value="">選択してください</option>
                            @foreach($prefectures as $key => $prefecture)
                                <option value="{{ $prefecture }}" {{ old('location2', $job->location2) == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="location3">勤務地3（任意）</label><br>
                        <select name="location3" id="location3" class="form_location">
                            <option value="">選択してください</option>
                            @foreach($prefectures as $key => $prefecture)
                                <option value="{{ $prefecture }}" {{ old('location3', $job->location3) == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="deadline">応募締切</label><br>
                        <input type="date" name="deadline" id="deadline" class="form_deadline" value="{{ old('deadline', $job->deadline->format('Y-m-d')) }}">
                    </div>
                </div>
                <div class="form_flex">
                    <div class="form_group">
                        <label for="work_days">勤務日数</label><br>
                        <div class="flex items-center">
                            週 <input type="number" name="work_days_min" id="work_days_min" min="1" max="7" class="form-control mx-2" style="width: 60px;" value="{{ old('work_days_min', $job->work_days_min) }}"> 日
                            ～
                            週 <input type="number" name="work_days_max" id="work_days_max" min="1" max="7" class="form-control mx-2" style="width: 60px;" value="{{ old('work_days_max', $job->work_days_max) }}"> 日
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="work_hours">勤務時間</label><br>
                        <div class="flex items-center">
                            <select name="work_hours_start" id="work_hours_start" class="form-control">
                                <option value="">選択してください</option>
                                @for ($i = 0; $i < 24; $i++)
                                    @php
                                        $time = sprintf('%02d:00', $i);
                                        $selected = old('work_hours_start', substr($job->work_hours_start, 0, 5)) == $time ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $time }}" {{ $selected }}>{{ $time }}</option>
                                @endfor
                            </select>
                            ～
                            <select name="work_hours_end" id="work_hours_end" class="form-control">
                                <option value="">選択してください</option>
                                @for ($i = 0; $i < 24; $i++)
                                    @php
                                        $time = sprintf('%02d:00', $i);
                                        $selected = old('work_hours_end', substr($job->work_hours_end, 0, 5)) == $time ? 'selected' : '';
                                    @endphp
                                    <option value="{{ $time }}" {{ $selected }}>{{ $time }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                <div class="form_block">
                    <label for="image">画像</label><br>
                    @if($job->image_path)
                        <img src="{{ asset('storage/' . $job->image_path) }}" alt="現在の画像" style="max-width: 200px;">
                        <p>新しい画像をアップロードする場合は以下を選択してください：</p>
                    @endif
                    <input type="file" class="form_image" id="image" name="image">
                </div>
                <div class="form_flex">
                    <a href="{{ route('admin.adminjob.index') }}" class="btn-primary">戻る</a>
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </div>
        </form>
    </main>
    <script src="/js/adminjobedit.js"></script>
</body>
</html>