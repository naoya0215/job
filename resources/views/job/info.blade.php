<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>応募手続き - 会員登録/ログイン</title>
    <link rel="stylesheet" href="/css/info.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>応募手続き</h1>
        </header>
        <main>
            <p class="intro-text">応募手続きには会員登録が必要です。<br>まだ会員登録していない方は会員登録を、既に会員登録がお済みの方はログインをお願いします。</p>
            <div class="button-container">
                <a href="{{ route('user.register') }}" class="btn btn-primary">新規会員登録</a>
                <a href="{{ route('user.login') }}" class="btn btn-secondary">ログイン</a>
            </div>
        </main>
    </div>
</body>
</html>