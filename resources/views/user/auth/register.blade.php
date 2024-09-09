<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/login.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="/css/adminregister.css">
</head>
<body>
    <div id="registrationForm">
        <form id="registerForm" method="POST" action="{{ route('user.register') }}" class="register-form">
            @csrf
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="adminInfo">
            <div class="text_login">
                <h3>氏名</h3>
                <input id="name" type="text" name="name" value="{{ old('name') }}" >
            </div>
            <div class="text_login">
                <h3>メールアドレス</h3>
                <input id="email" class="admin_login" type="email" name="email" value="{{ old('email') }}" >
            </div>
            <div class="text_login">
                <h3>パスワード</h3>
                <input id="password" class="admin_login" type="password" name="password" >
            </div>
            <div class="text_login">
                <h3>パスワード確認</h3>
                <input id="password_confirmation" type="password" name="password_confirmation" >
            </div>
            <button type="submit" class="login_button">登録</button>
        </form>
    </div> 
</body>
</html>