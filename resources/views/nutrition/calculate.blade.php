@extends('layouts.app')

@section('content')
    <h1>栄養情報の計算結果</h1>
    
    <p><strong>カロリー:</strong> {{ $nutritionalInfo['calories'] }} kcal</p>
    <p><strong>タンパク質:</strong> {{ $nutritionalInfo['protein'] }} g</p>
    <p><strong>脂質:</strong> {{ $nutritionalInfo['fat'] }} g</p>
    <p><strong>炭水化物:</strong> {{ $nutritionalInfo['carbohydrates'] }} g</p>
    <p><strong>食物繊維:</strong> {{ $nutritionalInfo['fiber'] }} g</p>
    <p><strong>糖質:</strong> {{ $nutritionalInfo['sugar'] }} g</p>
    
    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
@endsection
