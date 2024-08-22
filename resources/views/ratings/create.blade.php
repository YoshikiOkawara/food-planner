@extends('layouts.app')

@section('content')
<div class="container">
    <h1>新しいレシピを作成</h1>

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">レシピ名</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>
@endsection
