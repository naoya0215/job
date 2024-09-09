<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../css/adminlogin.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>新規登録</title>
    <link rel="stylesheet" href="/css/adminregister.css">
</head>
<body>
    <div id="registrationForm">
        <form id="registerForm" method="POST" action="{{ route('admin.register') }}" class="register-form">
            @csrf
            <div id="adminInfo">
                <div class="text_login">
                    <h3>企業名</h3>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                </div>
                <div class="text_login">
                    <h3>メールアドレス</h3>
                    <input id="email" class="admin_login" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="text_login">
                    <h3>パスワード</h3>
                    <input id="password" class="admin_login" type="password" name="password" required>
                </div>
                <div class="text_login">
                    <h3>パスワード確認</h3>
                    <input id="password_confirmation" type="password" name="password_confirmation" required />
                </div>
                <button type="button" id="nextButton" class="login_button">次へ</button>
            </div>
            <!--ここから企業情報登録-->
            <div id="companyInfo" style="display: none;">
                <h2>企業情報</h2>
                <div class="text_login">
                    <h3>所在地</h3>
                    <select name="prefecture_id" id="prefecture" class="register-form">
                        <option value="" selected disabled>都道府県を選択してください</option>
                        @foreach($prefectures as $prefecture)
                            <option value="{{ $prefecture->id }}">{{ $prefecture->prefecture_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text_login">
                    <h3>所在地詳細</h3>
                    <input id="location" type="text" name="location" value="{{ old('location') }}" placeholder="〇〇市〇〇区" required>
                </div>
                <div class="text_login">
                    <h3>企業説明</h3>
                    <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                </div>
                <div class="text_login">
                    <h3>Webサイト</h3>
                    <input id="website" type="url" name="website" value="{{ old('website') }}">
                </div>
                <button type="submit" class="login_button">登録</button>
                <button type="button" id="prevButton" class="login_button">戻る</button>
            </div>
        </form>
    </div>

    <script src="/js/adminregister.js"></script>
</body>
</html>
        

        
