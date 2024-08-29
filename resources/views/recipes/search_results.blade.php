@extends('layouts.app')

@section('content')
    <h1>レシピ検索結果</h1>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if(isset($recipes) && count($recipes) > 0)
        <div class="recipe-list">
            @foreach($recipes as $recipe)
                <div class="recipe-card">
                    <h3>{{ $recipe['title'] }}</h3>
                    <a href="{{ route('recipes.details', $recipe['id']) }}">詳細を見る</a>
                </div>
            @endforeach
        </div>
    @else
        <p>レシピが見つかりませんでした。</p>
    @endif
@endsection
