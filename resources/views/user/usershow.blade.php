<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求人詳細</title>
    <link rel="stylesheet" href="/css/jobshow.css">
</head>
<body>
    <div class="container">
        @if (session('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
        @endif
        <p class="job-show">{{ $job->company->admin->name }}</p>
        <div class="job-details">
            <h2>{{ $job->title }}</h2>
            <p class="job-show">{{ $job->secondaryCategory->name }}</p>
            @if($job->image_path)
            <div class="job-image">
                <img src="{{ asset('storage/' . $job->image_path) }}" alt="{{ $job->title }}">
            </div>
            @endif

            <div class="job-description">
                <h2>募集情報詳細</h2>
                {!! nl2br(e($job->description)) !!}
            </div>
            <p><strong>勤務地:</strong> {{ $job->location1 }}
                @if($job->location2) 、{{ $job->location2 }} @endif
                @if($job->location3) 、{{ $job->location3 }} @endif
            </p>
            <p><strong>給与:</strong> {{ $job->salary_type }} {{ number_format($job->min_salary) }}円 〜 {{ number_format($job->max_salary) }}円</p>
            <p><strong>雇用形態:</strong> {{ $job->type }}</p>
            <p><strong>勤務時間:</strong> {{ $job->formatted_work_hours_start }} 〜 {{ $job->formatted_work_hours_end }}</p>
            <p><strong>勤務日数:</strong> 週{{ $job->work_days_min }}日 〜 週{{ $job->work_days_max }}日</p>
            <p><strong>応募締切:</strong> {{ $job->deadline->format('Y年m月d日') }}</p>

            <!-- 応募するボタン -->
            <div class="apply-button-container">
                <a href="{{ route('user.userinfo', $job->id) }}" class="btn btn-apply">応募する</a>
            </div>
        </div>


        @if($relatedJobs->isNotEmpty())
            <div class="related-jobs">
                <h2>関連求人</h2>
                <ul>
                    @foreach($relatedJobs as $relatedJob)
                        <li><a href="{{ route('user.user.usershow', $relatedJob->id) }}">{{ $relatedJob->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('user.user.home') }}" class="btn btn-primary">求人一覧に戻る</a>
    </div>
</body>
</html>