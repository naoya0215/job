<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/login.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="/css/adminlogin.css">
</head>
<body>
    <div class="flex_wrapper">
        <form method="POST" action="{{ route('user.login') }}" class="login-form">
            @csrf
            <div class="text_login">
                <h3>メールアドレス</h3>
                <label for="email" :value="__('Email')" >
                <input id="email" class="admin_login" type="email" name="email" :value="old('email')" required autofocus >
            </div>
            <div class="text_login">
                <h3>パスワード</h3>
                <label for="password" :value="__('Password')" >
                <input id="password" class="admin_login" type="password" name="password" required autocomplete="current-password" >
            </div>
            <button class="login_button">
                {{ __('ログイン') }}
            </button>  
            <div class="reset_login">
                <a class="reset_pass" href="{{ route('user.register') }}">
                    {{ __('新規登録はこちら') }}
                </a>
            </div>
        </form>
    </div>
</body>
</html>
