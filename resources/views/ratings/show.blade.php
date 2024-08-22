@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $recipe->name }}</h1>
    <p>{{ $recipe->description }}</p>
    <p>平均評価: {{ round($recipe->ratings->avg('rating'), 1) }} / 5</p>

    <!-- 評価フォーム -->
    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">評価をつける (1～5):</label>
            <select name="rating" id="rating" class="form-control" required>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
        <button type="submit" class="btn btn-primary">評価を送信</button>
    </form>

    <h2>評価一覧</h2>
    @foreach($recipe->ratings as $rating)
        <div class="rating">
            <p>{{ $rating->user->name }}: {{ $rating->rating }} / 5</p>
        </div>
    @endforeach
</div>
@endsection
