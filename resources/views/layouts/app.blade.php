<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        nav {
            background-color: #343a40;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 18px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-form {
            text-align: center;
            margin-bottom: 40px;
        }

        .search-form input[type="text"] {
            width: 50%;
            padding: 10px;
            font-size: 18px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #ffffff;
            cursor: pointer;
        }

        .recipe-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .recipe-card {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .recipe-card h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #343a40;
        }

        .recipe-card p {
            margin: 5px 0;
            color: #6c757d;
        }

        .recipe-card a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="{{ route('recipes.index') }}">レシピ</a></li>
            <li><a href="{{ route('users.index') }}">ユーザー設定</a></li>
            <li><a href="{{ route('stock.management') }}">在庫管理</a></li>
            <li><a href="{{ route('ingredient_user.create') }}">アレルギーと好みの登録</a></li>
            <li><a href="{{ route('nutrition.index') }}">栄養情報管理</a></li>

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
        <div class="search-form">
            <form action="{{ route('recipes.search') }}" method="GET">
                <input type="text" name="query" placeholder="レシピを検索" required>
                <button type="submit">検索</button>
            </form>
        </div>

        <!-- メインコンテンツ -->
        @yield('content')
    </div>
</body>
</html>
