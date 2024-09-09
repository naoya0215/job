<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求人一覧</title>
    <link rel="stylesheet" href="/css/adminjobindex.css">
</head>
<body>
    <div>
        <!--ここにダッシュボードへ戻るボタンを作成する-->
    </div>
    <div class="container">
        <div class="create-job-button-container">
            <a href="{{ route('admin.home') }}" class="create-job-button">戻る</a>
            <a href="{{ route('admin.adminjob.create') }}" class="create-job-button">求人登録</a>
        </div>
        <!-- 検索フォームは後ほど実装 -->
        <table class="job-table">
            <thead>
                <tr>
                    <th>編集</th>
                    <th>求人番号</th>
                    <th>タイトル</th>
                    <th>職種</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr>
                    <td>
                        <form action="{{ route('admin.adminjob.edit', ['id' => $job->id]) }}" method="GET">
                            <button type="submit" class="edit">編集</button>
                        </form>
                    </td>
                    <td>{{ $job->job_number }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->primary_category_name }} > {{ $job->category_name }}</td>
                    <td>
                        <form action="{{ route('admin.adminjob.destroy', ['id' => $job->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" onclick="return confirm('本当にこの求人を削除しますか？');">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>