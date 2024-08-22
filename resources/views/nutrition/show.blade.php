@extends('layouts.app')

@section('content')
    <h1>総合的な栄養情報</h1>
    
    <p><strong>カロリー:</strong> {{ $nutritionalInfo['calories'] }} kcal</p>
    <p><strong>タンパク質:</strong> {{ $nutritionalInfo['protein'] }}</p>
    <p><strong>脂質:</strong> {{ $nutritionalInfo['fat'] }}</p>
    <p><strong>炭水化物:</strong> {{ $nutritionalInfo['carbohydrates'] }}</p>
    <p><strong>食物繊維:</strong> {{ $nutritionalInfo['fiber'] }}</p>
    <p><strong>糖質:</strong> {{ $nutritionalInfo['sugar'] }}</p>

    <a href="{{ url()->previous() }}">戻る</a>
@endsection
