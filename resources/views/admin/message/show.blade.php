<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>メッセージ</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/css/messageshow.css">
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-envelope"></i> メッセージ</h1>

        <a href="{{ route('admin.message.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> 戻る
        </a>

        <div class="applicant-info">
            <p><strong>ユーザー名:</strong> {{ e($applicant->user->name) }}</p>
            <p><strong>電話番号:</strong> {{ e($applicant->phone_number) }}</p>
            <p><strong>メールアドレス:</strong> {{ e($applicant->user->email) }}</p>
            <p><strong>自己PR:</strong> {{ e($applicant->self_pr) }}</p><br>
            <hr />
            <p><strong>求人タイトル:</strong> {{ e($applicant->job->title) }}</p>
            <p><strong>ステータス:</strong> <span class="status status-{{ strtolower($applicant->status) }}">{{ e($applicant->status) }}</span></p>
        </div>

        <div class="messages-container">
            @php
                $allMessages = $applicant->adminmessages->concat($applicant->usermessages)->sortBy('created_at');
            @endphp
            @foreach ($allMessages as $message)
                <div class="message {{ $message instanceof App\Models\AdminMessage ? 'admin' : 'user' }}">
                    <div class="message-header">
                        <strong>{{ e($message instanceof App\Models\AdminMessage ? 'あなた' : '応募ユーザー') }}</strong>
                        <span class="message-time">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    <p>{{ e($message->content) }}</p>
                </div>
            @endforeach
        </div>

        <form action="{{ route('admin.message.store', $applicant->id) }}" method="POST" class="message-form">
            @csrf
            <textarea name="content" placeholder="メッセージを入力" required></textarea>
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> 送信</button>
        </form>
    </div>
</body>
</html>