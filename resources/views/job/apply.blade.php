<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>応募フォーム</title>
    <link rel="stylesheet" href="/css/applyjob.css">
</head>
<body>
    <div class="container">
        <h1>求人応募フォーム</h1>
        <form action="{{ route('user.job.applystore', ['id' => $job->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $job->id }}">

            <div class="form-section">
                <h2>基本情報</h2>
                <div class="form-group">
                    <label for="name">氏名</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">電話番号</label>
                    <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number', $applicant->phone_number) }}" required>
                </div>
                <div class="form-group">
                    <label for="birth_date">生年月日</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $applicant->birth_date ? date('Y-m-d', strtotime($applicant->birth_date)) : '') }}" required>
                </div>
                <div class="form-group">
                    <label>性別</label>
                    <div class="radio-group">
                        <label><input type="radio" name="sex" value="male" {{ old('sex', $applicant->sex) == 'male' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="sex" value="female" {{ old('sex', $applicant->sex) == 'female' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="sex" value="other" {{ old('sex', $applicant->sex) == 'other' ? 'checked' : '' }}> その他</label>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h2>職歴・スキル</h2>
                <div class="form-group">
                    <label for="employment_status">現在の就業状況</label>
                    <select id="employment_status" name="employment_status" required>
                        <option value="">選択してください</option>
                        <option value="employed" {{ old('employment_status', $applicant->employment_status) == 'employed' ? 'selected' : '' }}>在職中</option>
                        <option value="unemployed" {{ old('employment_status', $applicant->employment_status) == 'unemployed' ? 'selected' : '' }}>離職中</option>
                        <option value="student" {{ old('employment_status', $applicant->employment_status) == 'student' ? 'selected' : '' }}>学生</option>
                        <option value="other" {{ old('employment_status', $applicant->employment_status) == 'other' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="self_pr">自己PR</label>
                    <textarea id="self_pr" name="self_pr" required>{{ old('self_pr', $applicant->self_pr) }}</textarea>
                </div>
            </div>

            <button type="submit" class="submit-btn">応募する</button>
        </form>
    </div>
</body>
</html>