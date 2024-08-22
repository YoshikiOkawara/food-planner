@extends('layouts.app')

@section('content')
    <h1>レシピ検索結果</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if(isset($recipes) && count($recipes) > 0)
        <ul>
            @foreach($recipes as $recipe)
                <li>
                    <h3>{{ $recipe['title'] }}</h3>
                    @if(isset($recipe['readyInMinutes']))
                        <p>準備時間: {{ $recipe['readyInMinutes'] }} 分</p>
                    @else
                        <p>準備時間: 情報なし</p>
                    @endif
                    @if(isset($recipe['servings']))
                        <p>提供人数: {{ $recipe['servings'] }} 人分</p>
                    @else
                        <p>提供人数: 情報なし</p>
                    @endif
                    <a href="{{ route('recipes.details', $recipe['id']) }}">詳細を見る</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>レシピが見つかりませんでした。</p>
    @endif
@endsection
