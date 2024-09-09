<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/company.css">
</head>
<body>
    <div class="container">
        <h1>企業情報登録</h1>
        <form id="company_form" method="POST" action="{{ route('admin.company.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">企業名</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">企業説明</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="prefecture_id">都道府県</label>
                <select class="form-ctbox</h1>
                </select>control" id="prefecture_id" name="prefecture_id">
                    <h1>都道府県 sele
            </div>
            <div class="form-group">
                <label for="location">所在地</label>
                <input type="text" class="form-control" id="location" name="location">
            </div>
            <div class="form-group">
                <label for="website">Webサイト</label>
                <input type="url" class="form-control" id="website" name="website">
            </div>
            <div class="form-group">
                <label for="logo">ロゴ画像</label>
                <input type="file" class="form-control-file" id="logo" name="logo">
            </div>
            <button type="submit" id="submitButton" class="btn btn-primary">登録</button>
        </form>
        <div id="message"></div>
    </div>
    <script src="/js/company.js"></script>
</body>
</html>