@extends('layouts.app')

@section('content')
    <h1>食事プラン一覧</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($mealPlans->isEmpty())
        <p>まだ食事プランが保存されていません。</p>
    @else
        <ul class="list-group">
            @foreach($mealPlans as $mealPlan)
                <li class="list-group-item">
                    <a href="{{ route('meal_plans.show', $mealPlan->id) }}">{{ $mealPlan->title }}</a>
                    <span>{{ $mealPlan->date->format('Y-m-d') }}</span>

                    <div class="float-right">
                        <a href="{{ route('meal_plans.edit', $mealPlan->id) }}" class="btn btn-sm btn-warning">編集</a>
                        <form action="{{ route('meal_plans.destroy', $mealPlan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">削除</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('meal_plans.create') }}" class="btn btn-primary mt-3">新しい食事プランを作成</a>
@endsection
