@extends('layouts.app')

@section('content')
    <h1>レシピ検索</h1>

    <form action="{{ route('recipes.search') }}" method="GET">
        <div>
            <label for="query">検索クエリ:</label>
            <input type="text" id="query" name="query" value="{{ old('query') }}" required>
        </div>
        <button type="submit">検索</button>
    </form>

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
@endsection
