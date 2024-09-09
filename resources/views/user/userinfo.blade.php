<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>応募確認</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/userinfo.css">
</head>
<body>
    <div class="container">
        @if(session('info'))
            <div class="alert">
                {{ session('info') }}
            </div>
        @endif
        <h1>応募確認</h1>
        <div class="applicant-info">
            <section class="info-section">
                <h2>基本情報</h2>
                <p><span>性別:</span> {{ $applicant->sex }}</p>
                <p><span>生年月日:</span> {{ $applicant->birth_date }}</p>
                <p><span>電話番号:</span> {{ $applicant->phone_number }}</p>
                <p><span>就業状況:</span> {{ $applicant->employment_status }}</p>
            </section>
            <section class="info-section">
                <h2>学歴</h2>
                <p><span>最終学歴:</span> {{ $applicant->academic_status }}</p>
                <p><span>学校名:</span> {{ $applicant->schoolname }}</p>
                <p><span>学部:</span> {{ $applicant->faculty }}</p>
                <p><span>卒業年月:</span> {{ $applicant->graduation }}年 {{ $applicant->graduation_month }}月</p>
            </section>
            <section class="info-section">
                <h2>職歴</h2>
                <p><span>転職回数:</span> {{ $applicant->jobchange }}</p>
                <div class="experience">
                    <h3>経験1</h3>
                    <p><span>職種:</span> {{ $applicant->experienced1 }}</p>
                    <p><span>経験年数:</span> {{ $applicant->experienced_years1 }}</p>
                    <p><span>職務内容:</span> {{ $applicant->experienced_content1 }}</p>
                </div>
                <!-- 経験2と3も同様に記述 -->
            </section>
            <section class="info-section">
                <h2>自己PR</h2>
                <p>{{ $applicant->self_pr }}</p>
            </section>
        </div>
        <div class="btn-container">
            <a href="{{ route('user.user.usershow', ['id' => $job->id]) }}" class="btn btn-back">詳細へ戻る</a>
            <a href="{{ route('user.usercomplete', ['id' => $job->id]) }}" class="btn btn-submit">応募する</a>
        </div>
    </div>
</body>
</html>