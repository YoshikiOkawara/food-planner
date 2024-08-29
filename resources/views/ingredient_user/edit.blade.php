@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>アレルギーと好みを編集</h2>

    <!-- エラーメッセージの表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ingredient_user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="allergy_info">アレルギー情報</label>
            <textarea class="form-control" id="allergy_info" name="allergy_info" rows="4">{{ old('allergy_info', $user->allergy_info) }}</textarea>
        </div>
        <div class="form-group">
            <label for="preference_info">好みの詳細</label>
            <textarea class="form-control" id="preference_info" name="preference_info" rows="4">{{ old('preference_info', $user->preference_info) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
