@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>レシピの編集</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('recipes.update', $recipe->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">名前:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $recipe->name) }}" required>
            </div>
            <div class="form-group">
                <label for="description">説明:</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $recipe->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="user_id">ユーザーID:</label>
                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id', $recipe->user_id) }}" readonly>
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
@endsection
