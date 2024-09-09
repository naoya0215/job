<!DOCTYPE html>
<html lang="en">
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
        <a href="{{ route('user.usermessage.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> 戻る
        </a>
        <div class="applicant-info">
            <p><strong>求人タイトル:</strong> {{ e($applicant->job->title) }}</p>
            <p><strong>会社名:</strong> {{ e($applicant->job->company->admin->name) }}</p>
            <p><strong>応募日:</strong> {{ $applicant->created_at->format('Y-m-d') }}</p>
        </div>

        <div class="messages-container">
            @php
                $allMessages = $applicant->adminmessages->concat($applicant->usermessages)->sortBy('created_at');
            @endphp
            @foreach ($allMessages as $message)
                <div class="message {{ $message instanceof App\Models\UserMessage ? 'admin' : 'user' }}">
                    <div class="message-header">
                        <strong>{{ e($message instanceof App\Models\AdminMessage ? '企業担当' : 'あなた') }}</strong>
                        <span class="message-time">{{ $message->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                    <p>{{ e($message->content) }}</p>
                </div>
            @endforeach
        </div>
        <form action="{{ route('user.usermessage.store', $applicant->id) }}" method="POST" class="message-form">
            @csrf
            <textarea name="content" placeholder="メッセージを入力" required></textarea>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> 送信
                </button>
            </div>
        </form>
    </div>
</body>
</html>