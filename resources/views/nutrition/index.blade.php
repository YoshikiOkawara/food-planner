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
                    <th>編集</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meals as $meal)
                    <tr>
                        <td>{{ $meal->type }}</td>
                        <td>{{ $meal->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('nutrition.show', ['id' => $meal->id]) }}" class="btn btn-info">表示</a>
                        </td>
                        <td>
                            <!-- 編集ページへのリンク -->
                            <a href="{{ route('nutrition.edit', $meal->id) }}">編集</a>
                        </td>
                        <td>
                            <!-- 削除フォーム -->
                            <form action="{{ route('nutrition.destroy', $meal->id) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('nutrition.create') }}" class="btn btn-primary">栄養情報の作成</a>
    <a href="{{ route('dashboard') }}">ダッシュボードに戻る</a>
@endsection
