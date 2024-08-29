<!-- resources/views/ingredient_user/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>アレルギーと好みの一覧</h2>

    <!-- 新規アレルギーと好みを登録するリンク -->
    <div class="mb-4">
        <a href="{{ route('ingredient_user.create') }}" class="btn btn-primary">新規登録</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ユーザー</th>
                <th>アレルギー情報</th>
                <th>好みの詳細</th>
                <th>機能</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ingredientUsers as $ingredientUser)
                <tr>
                    <td>{{ $ingredientUser->name }}</td>
                    <td>{{ $ingredientUser->allergy_info }}</td>
                    <td>{{ $ingredientUser->preference_info }}</td>
                    <td>
                        <a href="{{ route('ingredient_user.edit', $ingredientUser->id) }}" class="btn btn-warning">編集</a>
                        @if ($ingredientUser->id !== auth()->id())
                            <form action="{{ route('ingredient_user.destroy', $ingredientUser->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
