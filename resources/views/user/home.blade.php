<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>求人情報</title>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/css/jobhome.css">
</head>
<body>
    <header>
        <div class="header_icon">
            <a href="{{ route('user.user.home') }}">
                <h1>Job<span>Lication</span></h1><br>
            </a>
        </div>
        <div class="header_item">
            <p><form><a href="{{ route('user.history') }}">Web履歴書</a></form></p>
            <p><form><a href="{{ route('user.usermessage.index') }}">応募管理</a></form></p>
            <p>
                <form method="POST" action="{{ route('user.logout') }}">
                    @csrf
                    <a href="route('user.logout')"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </a>
                </form>    
            </p>
            <p>
                <form method="POST" action="{{ route('user.unsubscribe') }}" id="unsubscribe-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); if(confirm('本当に退会しますか？この操作は取り消せません。')) document.getElementById('unsubscribe-form').submit();">
                        退会する
                    </a>
                </form>
            </p>
        </div>
    </header> 
    <main>
        <div class="job_wrapper">
            <div class="job-search">
                <h3>求人検索</h3>
                <form action="{{ route('user.user.home') }}" method="GET">
                    <div class="search-group">
                        <label for="keyword">キーワード</label>
                        <input type="text" id="keyword" name="keyword" placeholder="求人タイトル" value="{{ request('keyword') }}">
                    </div>
                    <div class="search-group">
                        <label for="location">勤務地</label>
                        <select id="location" name="location">
                            <option value="">選択してください</option>
                            @foreach($prefectures as $key => $prefecture)
                                <option value="{{ $prefecture }}" {{ request('location') == $prefecture ? 'selected' : '' }}>{{ $prefecture }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-group">
                        <label for="employment_type">雇用形態</label>
                        <select id="employment_type" name="employment_type">
                            <option value="">選択してください</option>
                            @foreach(['パート・アルバイト', '派遣', '契約社員', '正社員', '委託・請負', 'フランチャイズ'] as $type)
                                <option value="{{ $type }}" {{ request('employment_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="search-group">
                        <label for="salary_min">最低給与</label>
                        <input type="number" id="salary_min" name="salary_min" placeholder="例: 200000" value="{{ request('salary_min') }}">
                    </div>
                    <div class="search-group">
                        <label for="salary_max">最高給与</label>
                        <input type="number" id="salary_max" name="salary_max" placeholder="例: 500000" value="{{ request('salary_max') }}">
                    </div>
                    <div class="search-group">
                        <label for="deadline">応募締め切り日</label>
                        <input type="date" id="deadline" name="deadline" value="{{ request('deadline') }}">
                    </div>
                    <div class="search-group">
                        <label for="category">カテゴリ</label>
                        <select id="category" name="category">
                            <option value="">選択してください</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ request('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="search-button">検索</button>
                </form>
            </div>
            <div class="job-list">
                @if($jobs->count() > 0)
                    @foreach($jobs as $job)
                    <a href="{{ route('user.user.usershow', ['id' => $job->id]) }}" class="job-card-link">
                        <div class="job-card">
                            <div class="job-content">
                                <p class="job-show">{{ $job->company->admin->name }}</p>
                                <div class="job-title">{{ $job->title }}</div>
                                <div class="company-name">{{ $job->company->name }}</div>
                                @if($job->image_path)
                                <img src="{{ asset('storage/' . $job->image_path) }}" alt="{{ $job->title }}" class="job-image">
                                @else
                                    <img src="{{ asset('images/default-job-image.jpg') }}" alt="Default Job Image" class="job-image">
                                @endif
                                <div class="job-details">
                                    <p>勤務地: {{ $job->location1 }}</p>
                                    <p>雇用形態: {{ $job->type }}</p>
                                    <p class="salary">
                                        給与: {{ $job->salary_type }} 
                                        {{ number_format($job->min_salary) }}円 
                                        @if($job->max_salary)
                                            ～ {{ number_format($job->max_salary) }}円
                                        @endif
                                    </p>
                                    <p>応募締切: {{ $job->deadline->format('Y年m月d日') }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                @else
                    <p>該当する求人が見つかりませんでした。</p>
                @endif
                <div class="pagination">
                {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>