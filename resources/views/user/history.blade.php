<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web履歴書</title>
    <link rel="stylesheet" href="/css/historyjob.css">
</head>
<body>
    <div class="container">
        <h1>Web履歴書作成</h1>
        <form action="{{ route('user.user.historystore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- バリデーションエラー表示 --}}
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-section">
                <h2>基本情報</h2>
                <div class="form-group">
                    <label for="name">氏名</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                </div>
                <div class="form-group">
                    <label for="phone_number">電話番号</label>
                    <input type="tel" id="phone_number" value="{{ old('phone_number', $applicant->phone_number) }}" name="phone_number">
                </div>
                <div class="form-group">
                    <label for="birth_date">生年月日</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $applicant->birth_date ? date('Y-m-d', strtotime($applicant->birth_date)) : '') }}">
                </div>
                <div class="form-group">
                    <label>性別</label>
                    <div class="radio-group">
                        <label><input type="radio" name="sex" value="male" {{ old('sex', $applicant->sex) == 'male' ? 'checked' : '' }}> 男性</label>
                        <label><input type="radio" name="sex" value="female" {{ old('sex', $applicant->sex) == 'female' ? 'checked' : '' }}> 女性</label>
                        <label><input type="radio" name="sex" value="other" {{ old('sex', $applicant->sex) == 'other' ? 'checked' : '' }}> その他</label>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h2>活動状況・自己PR</h2>
                <div class="form-group">
                    <label for="employment_status">現在の就業状況</label>
                    <select id="employment_status" name="employment_status">
                    <option value="">選択してください</option>
                        <option value="employed" {{ old('employment_status', $applicant->employment_status) == 'employed' ? 'selected' : '' }}>在職中</option>
                        <option value="unemployed" {{ old('employment_status', $applicant->employment_status) == 'unemployed' ? 'selected' : '' }}>離職中</option>
                        <option value="student" {{ old('employment_status', $applicant->employment_status) == 'student' ? 'selected' : '' }}>学生</option>
                        <option value="other" {{ old('employment_status', $applicant->employment_status) == 'other' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="self_pr">自己PR</label>
                    <textarea id="self_pr" name="self_pr">{{ old('self_pr', $applicant->self_pr) }}</textarea>
                </div>
            </div>
            <div class="form-section">
                <h2>学歴</h2>
                <div class="form-group">
                    <label for="academic_status">最終学歴</label>
                    <select id="academic_status" name="academic_status">
                        <option value="">選択してください</option>
                        <option value="graduate" {{ old('academic_status', $applicant->academic_status) == 'graduate' ? 'selected' : '' }}>大学院卒</option>
                        <option value="university" {{ old('academic_status', $applicant->academic_status) == 'university' ? 'selected' : '' }}>大学卒</option>
                        <option value="junior" {{ old('academic_status', $applicant->academic_status) == 'junior' ? 'selected' : '' }}>短大卒</option>
                        <option value="technical" {{ old('academic_status', $applicant->academic_status) == 'technical' ? 'selected' : '' }}>高専卒</option>
                        <option value="high" {{ old('academic_status', $applicant->academic_status) == 'high' ? 'selected' : '' }}>高校卒</option>
                        <option value="other" {{ old('academic_status', $applicant->academic_status) == 'other' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="schoolname">学校名</label>
                    <input type="text" id="schoolname" name="schoolname" value="{{ old('schoolname', $applicant->schoolname) }}">
                </div>
                <div class="form-group">
                    <label for="faculty">学部</label>
                    <input type="text" id="faculty" name="faculty" value="{{ old('faculty', $applicant->faculty) }}">
                </div>
                <div class="form-group">
                    <label for="graduation">卒業年</label>
                    <select id="graduation" name="graduation" class="form-control">
                        <option value="">選択してください</option>
                        @php
                            $currentYear = 2024;
                            $startYear = 1950;
                        @endphp
                        @for ($year = $currentYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}" {{ old('graduation', $applicant->graduation) == (string)$year ? 'selected' : '' }}>
                                {{ $year }}年
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="graduation_month">卒業月</label>
                    <select id="graduation_month" name="graduation_month">
                        <option value="">選択してください</option>
                        <option value="1" {{ old('graduation_month', $applicant->graduation_month) == '1' ? 'selected' : '' }}>1月</option>
                        <option value="2" {{ old('graduation_month', $applicant->graduation_month) == '2' ? 'selected' : '' }}>2月</option>
                        <option value="3" {{ old('graduation_month', $applicant->graduation_month) == '3' ? 'selected' : '' }}>3月</option>
                        <option value="4" {{ old('graduation_month', $applicant->graduation_month) == '4' ? 'selected' : '' }}>4月</option>
                        <option value="5" {{ old('graduation_month', $applicant->graduation_month) == '5' ? 'selected' : '' }}>5月</option>
                        <option value="6" {{ old('graduation_month', $applicant->graduation_month) == '6' ? 'selected' : '' }}>6月</option>
                        <option value="7" {{ old('graduation_month', $applicant->graduation_month) == '7' ? 'selected' : '' }}>7月</option>
                        <option value="8" {{ old('graduation_month', $applicant->graduation_month) == '8' ? 'selected' : '' }}>8月</option>
                        <option value="9" {{ old('graduation_month', $applicant->graduation_month) == '9' ? 'selected' : '' }}>9月</option>
                        <option value="10" {{ old('graduation_month', $applicant->graduation_month) == '10' ? 'selected' : '' }}>10月</option>
                        <option value="11" {{ old('graduation_month', $applicant->graduation_month) == '11' ? 'selected' : '' }}>11月</option>
                        <option value="12" {{ old('graduation_month', $applicant->graduation_month) == '12' ? 'selected' : '' }}>12月</option>
                    </select>
                </div>
            </div>
            <div class="form-section">
                <h2>職歴</h2>
                <div class="form-group">
                    <label for="jobchange">転職回数</label>
                    <input type="number" id="jobchange" name="jobchange" value="{{ old('jobchange', $applicant->jobchange) }}">
                </div>
                <div class="form-group">
                    <label for="experienced1">経験職種1</label>
                    <select id="experienced1" name="experienced1" class="form-control">
                    <option value="">選択してください</option>
                    @php
                    $jobTypes = [
                        'エンジニア' => [
                            'ソフトウェアエンジニア',
                            'フロントエンドエンジニア',
                            'バックエンドエンジニア',
                            'フルスタックエンジニア',
                            'モバイルアプリ開発者',
                            'データエンジニア',
                            'AI/機械学習エンジニア',
                            'DevOpsエンジニア',
                            'セキュリティエンジニア',
                        ],
                        'IT関連' => [
                            'プロジェクトマネージャー',
                            'プロダクトマネージャー',
                            'UIUXデザイナー',
                            'データアナリスト',
                            'ネットワークエンジニア',
                            'システム管理者',
                            'テクニカルサポート',
                        ],
                        'ビジネス' => [
                            'マーケティング',
                            '営業',
                            '人事',
                            '財務・経理',
                            '経営企画',
                            'コンサルタント',
                            'カスタマーサービス',
                        ],
                        'クリエイティブ' => [
                            'グラフィックデザイナー',
                            'Webデザイナー',
                            'コンテンツライター',
                            'ビデオ編集者',
                            'アニメーター',
                        ],
                        '教育・研究' => [
                            '教師',
                            '講師',
                            '研究員',
                            'トレーナー',
                        ],
                        '医療・福祉' => [
                            '医師',
                            '看護師',
                            '薬剤師',
                            '理学療法士',
                            '介護士',
                        ],
                        '製造・物流' => [
                            '製造オペレーター',
                            '品質管理',
                            '物流マネージャー',
                            '倉庫管理者',
                        ],
                        'サービス業' => [
                            '店舗管理者',
                            'シェフ',
                            'ホテルスタッフ',
                            '旅行プランナー',
                        ],
                        '建設・不動産' => [
                            '建築士',
                            '土木技師',
                            '不動産仲介',
                            'インテリアデザイナー',
                        ],
                        'その他' => [
                            '翻訳者',
                            'ジャーナリスト',
                            '法務',
                            '公務員',
                        ],
                    ];
                    @endphp

                    @foreach($jobTypes as $category => $jobs)
                        <optgroup label="{{ $category }}">
                            @foreach($jobs as $job)
                                <option value="{{ $job }}" {{ old('experienced1', $applicant->experienced1) == $job ? 'selected' : '' }}>
                                    {{ $job }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="experienced_years1">経験年数</label>
                    <input type="number" id="experienced_years1" name="experienced_years1" value="{{ old('experienced_years1', $applicant->experienced_years1) }}">
                </div>
                <div class="form-group">
                    <label for="experienced_content1">職務内容1</label>
                    <textarea id="experienced_content1" name="experienced_content1">{{ old('experienced_content1', $applicant->experienced_content1) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="experienced2">経験職種2</label>
                    <select id="experienced2" name="experienced2" class="form-control">
                    <option value="">選択してください</option>
                    @php
                    $jobTypes = [
                        'エンジニア' => [
                            'ソフトウェアエンジニア',
                            'フロントエンドエンジニア',
                            'バックエンドエンジニア',
                            'フルスタックエンジニア',
                            'モバイルアプリ開発者',
                            'データエンジニア',
                            'AI/機械学習エンジニア',
                            'DevOpsエンジニア',
                            'セキュリティエンジニア',
                        ],
                        'IT関連' => [
                            'プロジェクトマネージャー',
                            'プロダクトマネージャー',
                            'UIUXデザイナー',
                            'データアナリスト',
                            'ネットワークエンジニア',
                            'システム管理者',
                            'テクニカルサポート',
                        ],
                        'ビジネス' => [
                            'マーケティング',
                            '営業',
                            '人事',
                            '財務・経理',
                            '経営企画',
                            'コンサルタント',
                            'カスタマーサービス',
                        ],
                        'クリエイティブ' => [
                            'グラフィックデザイナー',
                            'Webデザイナー',
                            'コンテンツライター',
                            'ビデオ編集者',
                            'アニメーター',
                        ],
                        '教育・研究' => [
                            '教師',
                            '講師',
                            '研究員',
                            'トレーナー',
                        ],
                        '医療・福祉' => [
                            '医師',
                            '看護師',
                            '薬剤師',
                            '理学療法士',
                            '介護士',
                        ],
                        '製造・物流' => [
                            '製造オペレーター',
                            '品質管理',
                            '物流マネージャー',
                            '倉庫管理者',
                        ],
                        'サービス業' => [
                            '店舗管理者',
                            'シェフ',
                            'ホテルスタッフ',
                            '旅行プランナー',
                        ],
                        '建設・不動産' => [
                            '建築士',
                            '土木技師',
                            '不動産仲介',
                            'インテリアデザイナー',
                        ],
                        'その他' => [
                            '翻訳者',
                            'ジャーナリスト',
                            '法務',
                            '公務員',
                        ],
                    ];
                    @endphp

                    @foreach($jobTypes as $category => $jobs)
                        <optgroup label="{{ $category }}">
                            @foreach($jobs as $job)
                                <option value="{{ $job }}" {{ old('experienced2', $applicant->experienced2) == $job ? 'selected' : '' }}>
                                    {{ $job }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="experienced_years2">経験年数</label>
                    <input type="number" id="experienced_years2" name="experienced_years2" value="{{ old('experienced_years2', $applicant->experienced_years2) }}">
                </div>
                <div class="form-group">
                    <label for="experienced_content2">職務内容2</label>
                    <textarea id="experienced_content2" name="experienced_content2">{{ old('experienced_content2', $applicant->experienced_content2) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="experienced3">経験職種3</label>
                    <select id="experienced3" name="experienced3" class="form-control">
                    <option value="">選択してください</option>
                    @php
                    $jobTypes = [
                        'エンジニア' => [
                            'ソフトウェアエンジニア',
                            'フロントエンドエンジニア',
                            'バックエンドエンジニア',
                            'フルスタックエンジニア',
                            'モバイルアプリ開発者',
                            'データエンジニア',
                            'AI/機械学習エンジニア',
                            'DevOpsエンジニア',
                            'セキュリティエンジニア',
                        ],
                        'IT関連' => [
                            'プロジェクトマネージャー',
                            'プロダクトマネージャー',
                            'UIUXデザイナー',
                            'データアナリスト',
                            'ネットワークエンジニア',
                            'システム管理者',
                            'テクニカルサポート',
                        ],
                        'ビジネス' => [
                            'マーケティング',
                            '営業',
                            '人事',
                            '財務・経理',
                            '経営企画',
                            'コンサルタント',
                            'カスタマーサービス',
                        ],
                        'クリエイティブ' => [
                            'グラフィックデザイナー',
                            'Webデザイナー',
                            'コンテンツライター',
                            'ビデオ編集者',
                            'アニメーター',
                        ],
                        '教育・研究' => [
                            '教師',
                            '講師',
                            '研究員',
                            'トレーナー',
                        ],
                        '医療・福祉' => [
                            '医師',
                            '看護師',
                            '薬剤師',
                            '理学療法士',
                            '介護士',
                        ],
                        '製造・物流' => [
                            '製造オペレーター',
                            '品質管理',
                            '物流マネージャー',
                            '倉庫管理者',
                        ],
                        'サービス業' => [
                            '店舗管理者',
                            'シェフ',
                            'ホテルスタッフ',
                            '旅行プランナー',
                        ],
                        '建設・不動産' => [
                            '建築士',
                            '土木技師',
                            '不動産仲介',
                            'インテリアデザイナー',
                        ],
                        'その他' => [
                            '翻訳者',
                            'ジャーナリスト',
                            '法務',
                            '公務員',
                        ],
                    ];
                    @endphp

                    @foreach($jobTypes as $category => $jobs)
                        <optgroup label="{{ $category }}">
                            @foreach($jobs as $job)
                                <option value="{{ $job }}" {{ old('experienced3', $applicant->experienced3) == $job ? 'selected' : '' }}>
                                    {{ $job }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="experienced_years3">経験年数</label>
                    <input type="number" id="experienced_years3" name="experienced_years3" value="{{ old('experienced_years3', $applicant->experienced_years3) }}">
                </div>
                <div class="form-group">
                    <label for="experienced_content3">職務内容3</label>
                    <textarea id="experienced_content3" name="experienced_content3">{{ old('experienced_content3', $applicant->experienced_content3) }}</textarea>
                </div>
            </div>
            <button type="submit" class="submit-btn">登録情報の修正・変更を保存する</button>
        </form>
    </div>
    <script src="/js/history.js"></script>
</body>
</html>