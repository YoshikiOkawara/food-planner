@extends('layouts.app')

@section('content')
    <h1>食事プランの詳細</h1>
    
    <p><strong>食事タイプ:</strong> {{ $meal->type }}</p>

    <h2>食材情報</h2>
    <ul>
        @foreach($ingredients as $ingredient)
            <li>{{ $ingredient['name'] }} - {{ $ingredient['amount'] }} {{ $ingredient['unit'] }}</li>
        @endforeach
    </ul>
    
    <h2>栄養情報</h2>
    <p><strong>カロリー:</strong> {{ isset($nutritionalInfo['calories']) && is_numeric($nutritionalInfo['calories']) ? $nutritionalInfo['calories'] : 'N/A' }} kcal</p>
    <p><strong>タンパク質:</strong> {{ isset($nutritionalInfo['protein']) && is_numeric($nutritionalInfo['protein']) ? $nutritionalInfo['protein'] : 'N/A' }} g</p>
    <p><strong>脂質:</strong> {{ isset($nutritionalInfo['fat']) && is_numeric($nutritionalInfo['fat']) ? $nutritionalInfo['fat'] : 'N/A' }} g</p>
    <p><strong>炭水化物:</strong> {{ isset($nutritionalInfo['carbohydrates']) && is_numeric($nutritionalInfo['carbohydrates']) ? $nutritionalInfo['carbohydrates'] : 'N/A' }} g</p>

    <div class="actions">
        <!-- 編集ボタン -->
        <a href="{{ route('nutrition.edit', $meal->id) }}" class="btn btn-primary">編集</a>

        <!-- 削除フォーム -->
        <form action="{{ route('nutrition.destroy', $meal->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
        </form>

        <!-- 戻るボタン -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
    </div>
@endsection
