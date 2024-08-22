@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>食品データ一覧</h2>

    <a href="{{ route('daily_foods.create') }}" class="btn btn-primary mb-3">新規登録</a>

    <table class="table">
        <thead>
            <tr>
                <th>食材</th>
                <th>量</th>
                <th>食事の時間</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dailyFoods as $dailyFood)
                <tr>
                    <td>{{ $dailyFood->ingredient->name }}</td>
                    <td>{{ $dailyFood->amount }} g</td>
                    <td>{{ $dailyFood->meal_time }}</td>
                    <td>
                        <a href="{{ route('daily_foods.edit', $dailyFood->id) }}" class="btn btn-warning btn-sm">編集</a>
                        <form action="{{ route('daily_foods.destroy', $dailyFood->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
