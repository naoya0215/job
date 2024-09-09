<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>働くを応援</title>
    <link rel="stylesheet" href="/css/job.css">
</head>
<body>
    <header>
        <a href="{{ url('welcome') }}">
            <p>働くを応援！求人情報 <span>【JobLication】</span></p>
        </a>
        <div class="jobjob">
            <a href="{{ route('admin.login') }}">企業様専用</a>
        </div>
    </header>
    <main>
        <img src="/img/job4.jpg" alt="アプリ">
        <form action="{{ route('user.job.list') }}" method="GET">
            <div class="area">
                <p class="area_next">ご希望のエリアを選択してください</p>
                <div class="prefecture_area">
                    <p class="area_toggle" id="kanto">関東</p>
                    <p class="area_toggle" id="kansai">関西</p>
                    <p class="area_toggle" id="tokai">東海</p>
                    <p class="area_toggle" id="tohoku">北海道・東北</p>
                    <p class="area_toggle" id="hokuriku">北陸</p>
                    <p class="area_toggle" id="chugoku">中国</p>
                    <p class="area_toggle" id="shikoku">四国</p>
                    <p class="area_toggle" id="kyushiu">九州・沖縄</p>
                </div>
            </div>
            <div class="area_kanto">
                <p class="area_font" id="kanto_back">全国に戻る</p>
                <div class="prefecture_kanto">
                    <button type="submit" name="location" value="東京都" class="area_toggle">東京都</button>
                    <button type="submit" name="location" value="神奈川県" class="area_toggle">神奈川県</button>
                    <button type="submit" name="location" value="千葉県" class="area_toggle">千葉県</button>
                    <button type="submit" name="location" value="埼玉県" class="area_toggle">埼玉県</button>
                    <button type="submit" name="location" value="茨城県" class="area_toggle">茨城県</button>
                    <button type="submit" name="location" value="栃木県" class="area_toggle">栃木県</button>
                    <button type="submit" name="location" value="群馬県" class="area_toggle">群馬県</button>
                </div>
            </div>
            <div class="area_kansai">
                <p class="area_font" id="kansai_back">全国に戻る</p>
                <div class="prefecture_kansai">
                    <button type="submit" name="location" value="大阪府" class="area_toggle">大阪府</button>
                    <button type="submit" name="location" value="京都府" class="area_toggle">京都府</button>
                    <button type="submit" name="location" value="兵庫県" class="area_toggle">兵庫県</button>
                    <button type="submit" name="location" value="奈良県" class="area_toggle">奈良県</button>
                    <button type="submit" name="location" value="滋賀県" class="area_toggle">滋賀県</button>
                    <button type="submit" name="location" value="和歌山県" class="area_toggle">和歌山県</button>
                </div>
            </div>
            <div class="area_tokai">
                <p class="area_font" id="tokai_back">全国に戻る</p>
                <div class="prefecture_tokai">
                    <button type="submit" name="location" value="愛知県" class="area_toggle">愛知県</button>
                    <button type="submit" name="location" value="岐阜県" class="area_toggle">岐阜県</button>
                    <button type="submit" name="location" value="静岡県" class="area_toggle">静岡県</button>
                    <button type="submit" name="location" value="三重県" class="area_toggle">三重県</button>
                </div>
            </div>
            <div class="area_tohoku">
                <p class="area_font" id="tohoku_back">全国に戻る</p>
                <div class="prefecture_tohoku">
                    <button type="submit" name="location" value="北海道" class="area_toggle">北海道</button>
                    <button type="submit" name="location" value="青森県" class="area_toggle">青森県</button>
                    <button type="submit" name="location" value="岩手県" class="area_toggle">岩手県</button>
                    <button type="submit" name="location" value="宮城県" class="area_toggle">宮城県</button>
                    <button type="submit" name="location" value="秋田県" class="area_toggle">秋田県</button>
                    <button type="submit" name="location" value="山形県" class="area_toggle">山形県</button>
                    <button type="submit" name="location" value="福島県" class="area_toggle">福島県</button>
                </div>
            </div>
            <div class="area_hokuriku">
                <p class="area_font" id="hokuriku_back">全国に戻る</p>
                <div class="prefecture_hokuriku">
                    <button type="submit" name="location" value="新潟県" class="area_toggle">新潟県</button>
                    <button type="submit" name="location" value="富山県" class="area_toggle">富山県</button>
                    <button type="submit" name="location" value="石川県" class="area_toggle">石川県</button>
                    <button type="submit" name="location" value="福井県" class="area_toggle">福井県</button>
                    <button type="submit" name="location" value="長野県" class="area_toggle">長野県</button>
                    <button type="submit" name="location" value="山梨県" class="area_toggle">山梨県</button>
                </div>
            </div>
            <div class="area_chugoku">
                <p class="area_font" id="chugoku_back">全国に戻る</p>
                <div class="prefecture_chugoku">
                    <button type="submit" name="location" value="鳥取県" class="area_toggle">鳥取県</button>
                    <button type="submit" name="location" value="島根県" class="area_toggle">島根県</button>
                    <button type="submit" name="location" value="広島県" class="area_toggle">広島県</button>
                    <button type="submit" name="location" value="岡山県" class="area_toggle">岡山県</button>
                    <button type="submit" name="location" value="山口県" class="area_toggle">山口県</button>
                </div>
            </div>
            <div class="area_shikoku">
                <p class="area_font" id="shikoku_back">全国に戻る</p>
                <div class="prefecture_shikoku">
                    <button type="submit" name="location" value="愛媛県" class="area_toggle">愛媛県</button>
                    <button type="submit" name="location" value="高知県" class="area_toggle">高知県</button>
                    <button type="submit" name="location" value="香川県" class="area_toggle">香川県</button>
                    <button type="submit" name="location" value="徳島県" class="area_toggle">徳島県</button>
                </div>
            </div>
            <div class="area_kyushiu">
                <p class="area_font" id="kyushiu_back">全国に戻る</p>
                <div class="prefecture_kyushiu">
                    <button type="submit" name="location" value="福岡県" class="area_toggle">福岡県</button>
                    <button type="submit" name="location" value="佐賀県" class="area_toggle">佐賀県</button>
                    <button type="submit" name="location" value="長崎県" class="area_toggle">長崎県</button>
                    <button type="submit" name="location" value="熊本県" class="area_toggle">熊本県</button>
                    <button type="submit" name="location" value="大分県" class="area_toggle">大分県</button>
                    <button type="submit" name="location" value="宮崎県" class="area_toggle">宮崎県</button>
                    <button type="submit" name="location" value="鹿児島県" class="area_toggle">鹿児島県</button>
                    <button type="submit" name="location" value="沖縄県" class="area_toggle">沖縄県</button>
                </div>
            </div>
        </form>
    </main>    
    <script src="/js/job.js"></script>
</body>
</html>