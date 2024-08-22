@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $recipe->name }}を編集</h1>

    <form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">レシピ名</label>
            <input type="text" name="name" class="form-control" value="{{ $recipe->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" class="form-control" required>{{ $recipe->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
