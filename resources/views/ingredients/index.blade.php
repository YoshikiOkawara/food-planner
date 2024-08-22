@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>食材一覧</h2>
    <a href="{{ route('ingredients.create') }}" class="btn btn-primary">新規作成</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>名前</th>
                <th>カロリー</th>
                <th>炭水化物</th>
                <th>たんぱく質</th>
                <th>脂質</th>
                <th>ビタミン</th>
                <th>ミネラル</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->calorie }}</td>
                    <td>{{ $ingredient->carbohydrate }}</td>
                    <td>{{ $ingredient->protein }}</td>
                    <td>{{ $ingredient->fat }}</td>
                    <td>{{ $ingredient->vitamin }}</td>
                    <td>{{ $ingredient->mineral }}</td>
                    <td>
                        <a href="{{ route('ingredients.edit', $ingredient->id) }}" class="btn btn-warning btn-sm">編集</a>
                        <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
