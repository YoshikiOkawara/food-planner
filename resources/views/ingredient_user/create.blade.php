@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>アレルギーと好みを登録</h2>

    <form action="{{ route('ingredient_user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">ユーザー</label>
            <select class="form-control" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="allergy_info">アレルギー情報</label>
            <textarea class="form-control" id="allergy_info" name="allergy_info" rows="4" placeholder="アレルギーの詳細（例: ナッツアレルギー）"></textarea>
        </div>
        <div class="form-group">
            <label for="preference_info">好みの詳細</label>
            <textarea class="form-control" id="preference_info" name="preference_info" rows="4" placeholder="好みの詳細（例: 甘いものが好き）"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection
