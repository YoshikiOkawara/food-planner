@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>食品データを編集</h2>

    <form action="{{ route('daily_foods.update', $dailyFood->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="ingredient_id">食材</label>
            <select name="ingredient_id" class="form-control" id="ingredient_id" required>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}" {{ $dailyFood->ingredient_id == $ingredient->id ? 'selected' : '' }}>
                        {{ $ingredient->name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('ingredient_id'))
                <span class="text-danger">{{ $errors->first('ingredient_id') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="amount">量（グラム）</label>
            <input type="number" name="amount" class="form-control" id="amount" value="{{ $dailyFood->amount }}" required>
            @if ($errors->has('amount'))
                <span class="text-danger">{{ $errors->first('amount') }}</span>
            @endif
        </div>

        <div class="form-group">
            <label for="meal_time">食事の時間</label>
            <select name="meal_time" class="form-control" id="meal_time" required>
                <option value="朝食" {{ $dailyFood->meal_time == '朝食' ? 'selected' : '' }}>朝食</option>
                <option value="昼食" {{ $dailyFood->meal_time == '昼食' ? 'selected' : '' }}>昼食</option>
                <option value="夕食" {{ $dailyFood->meal_time == '夕食' ? 'selected' : '' }}>夕食</option>
            </select>
            @if ($errors->has('meal_time'))
                <span class="text-danger">{{ $errors->first('meal_time') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
