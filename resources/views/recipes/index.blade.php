@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('recipes.create') }}" class="btn btn-primary mb-3">新しいレシピを作成</a>

        <table class="table">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>説明</th>
                    <th>投稿者</th>
                    <th>機能</th>
                    <th>評価</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipes as $recipe)
                    <tr>
                        <td>{{ $recipe->name }}</td>
                        <td>{{ $recipe->description }}</td>
                        <td>{{ $recipe->user->name }}</td> <!-- 投稿者の名前を表示 -->
                        <td>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-sm btn-primary">View</a>
                            @if ($recipe->user_id === Auth::id())
                                <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($recipe->user_id !== Auth::id())
                                @php
                                    $userRating = $recipe->userRating(Auth::id());
                                    $userRatingValue = $userRating ? $userRating->rating : null;
                                @endphp

                                <form action="{{ route('recipes.rate', $recipe->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <select name="rating" required>
                                        <option value="1" {{ $userRatingValue == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $userRatingValue == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $userRatingValue == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $userRatingValue == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $userRatingValue == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                    <button type="submit" class="btn btn-success btn-sm">Rate</button>
                                </form>
                            @else
                                <p>自分のレシピには評価を付けることができません。</p>
                            @endif
                            <br>
                            <p>平均評価: {{ $recipe->ratings->avg('rating') ? round($recipe->ratings->avg('rating'), 2) : 'No ratings yet' }}</p>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection