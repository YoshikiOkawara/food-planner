@extends('layouts.app')

@section('content')
    <div class="recipe-details">
        <!-- レシピタイトル -->
        @if(is_array($recipeDetails) && isset($recipeDetails['title']))
            <h1 class="recipe-title">{{ $recipeDetails['title'] }}</h1>

            <!-- レシピ画像 -->
            @if(isset($recipeDetails['image']))
                <div class="recipe-image">
                    <img src="{{ $recipeDetails['image'] }}" alt="{{ $recipeDetails['title'] }}" class="img-fluid">
                </div>
            @endif

            <!-- 概要 -->
            @if(isset($recipeDetails['summary']))
                <div class="recipe-summary">
                    {!! nl2br(e($recipeDetails['summary'])) !!}
                </div>
            @endif

            <!-- 準備時間と提供人数 -->
            <div class="recipe-info">
                <p><strong>準備時間:</strong> {{ $recipeDetails['readyInMinutes'] ?? '情報なし' }} 分</p>
                <p><strong>提供人数:</strong> {{ $recipeDetails['servings'] ?? '情報なし' }} 人分</p>
            </div>

            <!-- 材料 -->
            <div class="recipe-ingredients">
                <h2>材料</h2>
                <ul>
                    @forelse($recipeDetails['extendedIngredients'] ?? [] as $ingredient)
                        <li>{{ $ingredient['original'] }}</li>
                    @empty
                        <li>材料情報なし</li>
                    @endforelse
                </ul>
            </div>

            <!-- 作り方 -->
            <div class="recipe-instructions">
                <h2>作り方</h2>
                <ol>
                    @if(isset($recipeDetails['instructions']))
                        {!! nl2br(e($recipeDetails['instructions'])) !!}
                    @else
                        <li>作り方情報なし</li>
                    @endif
                </ol>
            </div>

            <!-- 戻るボタン -->
            <div class="back-button">
                <a href="{{ route('recipes.search.results') }}" class="btn btn-secondary">検索結果に戻る</a>
            </div>
        @else
            <p>レシピ詳細情報が取得できませんでした。</p>
        @endif
    </div>
@endsection
