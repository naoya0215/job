<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>応募完了</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/complete.css">
</head>
<body>
    <div class="container">
        <div class="completion-card">
            <div class="icon-container">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h1>応募完了</h1>
            <p class="job-title">{{ $job->title }}</p>
            <p class="message">への応募が完了しました。</p>
            <p class="thank-you">ご応募ありがとうございます。担当者より連絡させていただきます。</p>
            <a href="{{ route('user.user.home') }}" class="btn btn-primary">求人一覧に戻る</a>
        </div>
    </div>
</body>
</html>