@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>在庫を編集</h2>
    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="user_id">ユーザー</label>
            <input type="text" name="user_id" class="form-control" id="user_id" value="{{ $stock->user_id }}" required>
            @if ($errors->has('user_id'))
                <span class="text-danger">{{ $errors->first('user_id') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="ingredient_id">食材</label>
            <input type="text" name="ingredient_id" class="form-control" id="ingredient_id" value="{{ $stock->ingredient_id }}" required>
            @if ($errors->has('ingredient_id'))
                <span class="text-danger">{{ $errors->first('ingredient_id') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="quantity">量（グラム）</label>
            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $stock->quantity }}" required>
            @if ($errors->has('quantity'))
                <span class="text-danger">{{ $errors->first('quantity') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="expiration_date">消費期限</label>
            <input type="date" name="expiration_date" class="form-control" id="expiration_date" value="{{ $stock->expiration_date }}" required>
            @if ($errors->has('expiration_date'))
                <span class="text-danger">{{ $errors->first('expiration_date') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="best_before_date">賞味期限</label>
            <input type="date" name="best_before_date" class="form-control" id="best_before_date" value="{{ $stock->best_before_date }}" required>
            @if ($errors->has('best_before_date'))
                <span class="text-danger">{{ $errors->first('best_before_date') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">在庫を更新</button>
    </form>
</div>
@endsection
