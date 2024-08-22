@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>食材情報を編集</h2>

    <form action="{{ route('ingredients.update', $ingredient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">食材名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $ingredient->name) }}" required>
        </div>
        <div class="form-group">
            <label for="calorie">カロリー</label>
            <input type="number" class="form-control" id="calorie" name="calorie" value="{{ old('calorie', $ingredient->calorie) }}">
        </div>
        <div class="form-group">
            <label for="carbohydrate">炭水化物</label>
            <input type="number" class="form-control" id="carbohydrate" name="carbohydrate" value="{{ old('carbohydrate', $ingredient->carbohydrate) }}">
        </div>
        <div class="form-group">
            <label for="protein">たんぱく質</label>
            <input type="number" class="form-control" id="protein" name="protein" value="{{ old('protein', $ingredient->protein) }}">
        </div>
        <div class="form-group">
            <label for="fat">脂質</label>
            <input type="number" class="form-control" id="fat" name="fat" value="{{ old('fat', $ingredient->fat) }}">
        </div>
        <div class="form-group">
            <label for="vitamin">ビタミン</label>
            <input type="number" class="form-control" id="vitamin" name="vitamin" value="{{ old('vitamin', $ingredient->vitamin) }}">
        </div>
        <div class="form-group">
            <label for="mineral">ミネラル</label>
            <input type="number" class="form-control" id="mineral" name="mineral" value="{{ old('mineral', $ingredient->mineral) }}">
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
