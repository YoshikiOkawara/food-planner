@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>在庫管理</h2>

    <!-- 新規登録ボタン -->
    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">新しい在庫を登録</a>

    <table class="table">
        <thead>
            <tr>
                <th>ユーザー</th>
                <th>食材</th>
                <th>量（グラム）</th>
                <th>消費期限</th>
                <th>賞味期限</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                @php
                    $isExpired = $stock->expiration_date && $stock->expiration_date < $today;
                    $isBestBefore = $stock->best_before_date && $stock->best_before_date < $today;
                @endphp
                <tr class="{{ $isExpired ? 'table-danger' : ($isBestBefore ? 'table-warning' : '') }}">
                    <td>{{ $stock->user->name }}</td>
                    <td>{{ $stock->ingredient->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->expiration_date ? $stock->expiration_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ $stock->best_before_date ? $stock->best_before_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">編集</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Expiration and Best Before Alerts -->
    <h3 class="mt-5">アラート</h3>
    <ul class="list-group">
        @foreach($stocks as $stock)
            @if($stock->expiration_date && $stock->expiration_date < $today)
                <li class="list-group-item list-group-item-danger">
                    <i class="fas fa-exclamation-triangle"></i> Expired: {{ $stock->ingredient->name }} ({{ $stock->expiration_date->format('Y-m-d') }})
                </li>
            @elseif($stock->best_before_date && $stock->best_before_date < $today)
                <li class="list-group-item list-group-item-warning">
                    <i class="fas fa-calendar-check"></i> Best Before: {{ $stock->ingredient->name }} ({{ $stock->best_before_date->format('Y-m-d') }})
                </li>
            @endif
        @endforeach
    </ul>
</div>
@endsection
