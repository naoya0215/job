<header>
    <div class="icon">
    </div>
    <ul>
        <li>ようこそ{{ $admin->name }}さん</li>
        <li><a href="#">プロフィール編集</a></li>
        @can('manager')
            <li><a href="{{ route('admin.staies.index') }}">宿泊予約</a></li>
            <li><a href="{{ route('admin.customers.index') }}">お客様情報</a></li>
        @endcan
        @can('staff')
        <li><a href="{{ route('admin.products.index') }}">ショッピング</a></li>
        <li><a href="{{ route('admin.images.index') }}">画像アップロード</a></li>
        <li>イベント</li>
        <li>クーポン</li>
        <li>登録者一覧</li>
        <li>問い合わせ</li>
        @endcan
    </ul> 
</header>