@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>新しい食材を登録</h2>

    <form action="{{ route('ingredients.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">食材名</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="calorie">カロリー</label>
            <input type="number" class="form-control" id="calorie" name="calorie">
        </div>
        <div class="form-group">
            <label for="carbohydrate">炭水化物</label>
            <input type="number" class="form-control" id="carbohydrate" name="carbohydrate">
        </div>
        <div class="form-group">
            <label for="protein">たんぱく質</label>
            <input type="number" class="form-control" id="protein" name="protein">
        </div>
        <div class="form-group">
            <label for="fat">脂質</label>
            <input type="number" class="form-control" id="fat" name="fat">
        </div>
        <div class="form-group">
            <label for="vitamin">ビタミン</label>
            <input type="number" class="form-control" id="vitamin" name="vitamin">
        </div>
        <div class="form-group">
            <label for="mineral">ミネラル</label>
            <input type="number" class="form-control" id="mineral" name="mineral">
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection
