<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('recipes.index') }}">レシピ</a></li>
            <li><a href="{{ route('users.index') }}">ユーザー設定</a></li>
            <li><a href="{{ route('stock.management') }}">在庫管理</a></li>
            <li><a href="{{ route('ingredient_user.create') }}">アレルギーと好みの登録</a></li>
            <li><a href="{{ route('ingredients.index') }}">栄養素分析</a></li>
            <li><a href="{{ route('daily_foods.create') }}">食品データの入力</a></li>
            <li><a href="{{ route('nutrition.index') }}">栄養情報管理</a></li>
            <li><a href="{{ route('nutrition.calculate') }}">栄養価を計算</a></li>

            @guest
                <li><a href="{{ route('login') }}">ログイン</a></li>
                <li><a href="{{ route('register') }}">登録</a></li>
            @else
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </nav>

    <div class="container">
        <!-- 検索フォームの追加 -->
        <form action="{{ route('recipes.search') }}" method="GET" style="margin-bottom: 20px;">
            <input type="text" name="query" placeholder="レシピを検索" required>
            <button type="submit">検索</button>
        </form>

        @yield('content')

        <!-- 検索結果の表示 -->
        @if(isset($recipes))
            @if(count($recipes) > 0)
                <h2>検索結果:</h2>
                <ul>
                    @foreach($recipes as $recipe)
                        <li>
                            <h3>{{ $recipe['title'] }}</h3>
                            <p>準備時間: {{ $recipe['readyInMinutes'] ?? '情報なし' }} 分</p>
                            <p>提供人数: {{ $recipe['servings'] ?? '情報なし' }} 人分</p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>レシピが見つかりませんでした。</p>
            @endif
        @endif
    </div>
</body>
</html>
