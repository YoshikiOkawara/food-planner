@extends('layouts.app')

@section('content')
    <h1>新しいレシピを作成</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="description">説明:</label>
            <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        </div>
        <!-- ユーザーIDを隠しフィールドとして追加 -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <button type="submit">作成する</button>
    </form>
@endsection
