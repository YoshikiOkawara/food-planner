@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                レシピ詳細
            </div>
            <div class="card-body">
                <p><strong>名前:</strong> {{ $recipe->name }}</p>
                <p><strong>説明:</strong> {{ $recipe->description }}</p>
                <p><strong>作成者:</strong> {{ $recipe->user->name }}</p>
                <p><strong>作成日時:</strong> {{ $recipe->created_at }}</p>
                <p><strong>更新日時:</strong> {{ $recipe->updated_at }}</p>

                <!-- 栄養素情報 -->
                <div class="mt-4">
                    <h3>栄養素情報</h3>
                    @if(isset($nutritionalInfo['calories']))
                        <p><strong>カロリー:</strong> {{ $nutritionalInfo['calories'] }} kcal</p>
                    @endif
                    @if(isset($nutritionalInfo['fat']))
                        <p><strong>脂肪:</strong> {{ $nutritionalInfo['fat'] }} g</p>
                    @endif
                    @if(isset($nutritionalInfo['protein']))
                        <p><strong>タンパク質:</strong> {{ $nutritionalInfo['protein'] }} g</p>
                    @endif
                    @if(isset($nutritionalInfo['carbs']))
                        <p><strong>炭水化物:</strong> {{ $nutritionalInfo['carbs'] }} g</p>
                    @endif
                </div>

                <!-- 評価フォーム -->
                @if ($recipe->user_id !== Auth::id())
                    <div class="mt-4">
                        <form action="{{ route('recipes.rate', $recipe->id) }}" method="POST">
                            @csrf
                            <label for="rating">このレシピを評価:</label>
                            <select name="rating" id="rating" required>
                                <option value="1" {{ $recipe->userRating(Auth::id()) ? ($recipe->userRating(Auth::id())->rating == 1 ? 'selected' : '') : '' }}>1</option>
                                <option value="2" {{ $recipe->userRating(Auth::id()) ? ($recipe->userRating(Auth::id())->rating == 2 ? 'selected' : '') : '' }}>2</option>
                                <option value="3" {{ $recipe->userRating(Auth::id()) ? ($recipe->userRating(Auth::id())->rating == 3 ? 'selected' : '') : '' }}>3</option>
                                <option value="4" {{ $recipe->userRating(Auth::id()) ? ($recipe->userRating(Auth::id())->rating == 4 ? 'selected' : '') : '' }}>4</option>
                                <option value="5" {{ $recipe->userRating(Auth::id()) ? ($recipe->userRating(Auth::id())->rating == 5 ? 'selected' : '') : '' }}>5</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-2">評価を送信</button>
                        </form>
                    </div>
                @else
                    <p>自分のレシピには評価を付けることができません。</p>
                @endif

                <!-- レシピの評価を表示 -->
                <div class="mt-4">
                    <h3>評価</h3>
                    <p><strong>平均評価:</strong> {{ $recipe->rating ? number_format($recipe->rating, 1) : 'まだ評価がありません' }}</p>
                    <p><strong>総評価数:</strong> {{ $recipe->ratings->count() }}</p>
                </div>

            </div>
        </div>
        <a href="{{ route('recipes.index') }}" class="btn btn-primary mt-3">レシピ一覧に戻る</a>
    </div>
@endsection
