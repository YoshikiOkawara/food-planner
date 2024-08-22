@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>新しい在庫を登録</h2>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <!-- ユーザー選択 -->
        <div class="form-group">
            <label for="user_id">ユーザー</label>
            <select name="user_id" class="form-control" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('user_id'))
                <span class="text-danger">{{ $errors->first('user_id') }}</span>
            @endif
        </div>

        <!-- 食材選択 -->
        <div class="form-group">
            <label for="ingredient_id">食材</label>
            <select name="ingredient_id" class="form-control" id="ingredient_id" required>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('ingredient_id'))
                <span class="text-danger">{{ $errors->first('ingredient_id') }}</span>
            @endif
        </div>

        <!-- 量入力 -->
        <div class="form-group">
            <label for="quantity">量（グラム）</label>
            <input type="number" name="quantity" class="form-control" id="quantity" required>
            @if ($errors->has('quantity'))
                <span class="text-danger">{{ $errors->first('quantity') }}</span>
            @endif
        </div>

        <!-- 消費期限入力 -->
        <div class="form-group">
            <label for="expiration_date">消費期限</label>
            <input type="date" name="expiration_date" class="form-control" id="expiration_date" required>
            @if ($errors->has('expiration_date'))
                <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
            @endif
        </div>

        <!-- 賞味期限入力 -->
        <div class="form-group">
            <label for="best_before_date">賞味期限</label>
            <input type="date" name="best_before_date" class="form-control" id="best_before_date" required>
            @if ($errors->has('best_before_date'))
                <span class="text-danger">{{ $errors->first('best_before_date') }}</span>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">在庫を登録</button>
    </form>
</div>
@endsection
