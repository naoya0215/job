<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>応募一覧</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/css/messageindex.css">
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-users"></i> 応募一覧</h1>

        <div class="table-responsive">
            <table class="applicant-table">
                <thead>
                    <tr>
                        <th>
                            <a href="{{ route('admin.home') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> 戻る
                            </a>
                        </th>
                        <th>ユーザー名</th>
                        <th>求人タイトル</th>
                        <th>ステータス</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $applicant)
                        <tr>
                            <td></td>
                            <td>{{ $applicant->user->name }}</td>
                            <td class="truncate">{{ $applicant->job->title }}</td>
                            <td><span class="status status-{{ strtolower($applicant->status) }}">{{ $applicant->status }}</span></td>
                            <td>
                                <a href="{{ route('admin.message.show', $applicant->id) }}" class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> メッセージ
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>