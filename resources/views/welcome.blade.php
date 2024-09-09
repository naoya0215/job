<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>JobLication</title>
        <link rel="stylesheet" href="css/style.css">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body>
        <!--
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        -->
        <header>
            <div class="header_icon">
                <a href="{{ url('welcome') }}"><h1>Job<span>Lication</span></h1><br></a>
            </div>
            <div class="header_item">
                <p><a href="{{ route('user.job.index') }}">働くを応援</a></p>
                <p><a href="{{ route('user.job.list') }}">求人情報</a></p>
                <p><a href="{{ route('user.login') }}">ログイン</a></p>
            </div>
        </header> 
        <main>
            <img src="img/job1.jpg" alt="メイン画像">
            <div class="main_view">
                <h2>幅広い年齢・経験の人が活躍！</h2>
                <div class="main_flex">
                    <p>ブランクOK、未経験歓迎のお仕事たくさん。<br><span>平均年齢20～40歳の方中心に利用頂いてます。</span></p>
                    <img src="img/job2.jpg" alt="働く">
                </div>
            </div>
            <div class="main_interview">
                <h2>ユーザーインタビュー</h2>
                <div class="interview_flex">
                    <img src="img/job3.jpg" alt="働くモグラ">
                    <p>Tさん・建設作業員<br>
                    <span>
                    建設の世界に足を踏み入れてから、工事現場での仕事の魅力にすっかり惹かれています。毎日異なる課題に直面し、チームで協力して大きなプロジェクトを形にしていく過程は、とてもやりがいがあります。重機を操作する技術を磨いたり、新しい建築技術を学んだりと、常に成長の機会があります。屋外での作業は体力的にはきついですが、日々変化していく現場を目の当たりにできるのは本当に興奮します。様々な職種の人々と協力し合う中で、コミュニケーション能力も向上しました。安全第一を心がけながらも、完成した建物を見上げたときの達成感は何物にも代えがたいものです。工事現場は、自分の努力が目に見える形で結実する、とてもやりがいのある職場だと感じています。</span></p>
                </div>
            </div>
        </main>    
        <footer>
            <h1>Job<span>Job</span></h1><br>
            <p>Copyright © b-style media Inc.All Rights Reserved.</p>
            <p>system_create : naoya kobayashi</p>
        </footer>
    </body>
</html>
