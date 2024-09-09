<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ダッシュボード</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <div class="dashboard">
        <nav class="sidebar">
            <div class="logo">
                <h1>管理者パネル</h1>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('admin.adminjob.index') }}"><i class="fas fa-briefcase"></i> 求人作成</a></li>
                <li><a href="{{ route('admin.message.index') }}"><i class="fas fa-envelope"></i> 応募管理</a></li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt"></i> ログアウト
                        </a>
                    </form>
                </li>
                <li>
                    <form method="POST" action="{{ route('admin.unsubscribe') }}" onsubmit="return confirm('本当に退会しますか？この操作は取り消せません。');">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-user-times"></i> 退会する
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <main class="content">
            <header class="top-bar">
                <h2>ダッシュボード</h2>
                <div class="user-info">
                    <span>ようこそ<br>{{ Auth::user()->name }}さん</span>
                </div>
            </header>
            <div class="dashboard-content">
                <div class="card">
                    <h3>掲載した求人</h3>
                    <ul>
                        @foreach($jobs as $job)
                            <li>
                                {{ $job->title }} - 応募数: {{ $job->applicants_count }}
                            </li>
                            <hr />
                        @endforeach
                    </ul>
                </div>
                <div class="card">
                    <h3>総応募数</h3>
                    <p>{{ $totalApplicants }}</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>