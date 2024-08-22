@extends('layouts.app')

@section('content')
<div class="container">
    <h1>レシピ一覧</h1>
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->name }}</h5>
                        <p class="card-text">{{ $recipe->description }}</p>
                        <p>平均評価: {{ round($recipe->ratings->avg('rating'), 1) }} / 5</p>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
