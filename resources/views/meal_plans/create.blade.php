@extends('layouts.app')

@section('content')
    <h1>食事プランの作成</h1>

    <form action="{{ route('meal_plans.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">説明:</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="date">日付:</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection
