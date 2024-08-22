@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>食品データの入力</h2>
    <form action="{{ route('daily_foods.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="ingredient_id">食材</label>
            <select name="ingredient_id" id="ingredient_id" class="form-control" required>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="amount">量（グラム）</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="meal_time">食事の時間帯</label>
            <select name="meal_time" id="meal_time" class="form-control" required>
                <option value="朝食">朝食</option>
                <option value="昼食">昼食</option>
                <option value="夕食">夕食</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
</div>
@endsection
