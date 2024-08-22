<!-- resources/views/nutrition/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>食事プラン一覧</h1>

    @if($meals->isEmpty())
        <p>まだ食事プランが保存されていません。</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>食事タイプ</th>
                    <th>作成日</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meals as $meal)
                    <tr>
                        <td>{{ $meal->type }}</td>
                        <td>{{ $meal->created_at->format('Y-m-d') }}</td>
                        <td><a href="{{ route('nutrition.show', $meal->id) }}">表示</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('dashboard') }}">ダッシュボードに戻る</a>
@endsection
