@extends('layouts.app')

@section('content')
    <h1>食事プランの編集</h1>

    <form action="{{ route('nutrition.update', $meal->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="meal_type">食事タイプ:</label>
            <select name="meal_type" id="meal_type" class="form-control" required>
                <option value="breakfast" {{ $meal->type == 'breakfast' ? 'selected' : '' }}>朝食</option>
                <option value="lunch" {{ $meal->type == 'lunch' ? 'selected' : '' }}>昼食</option>
                <option value="dinner" {{ $meal->type == 'dinner' ? 'selected' : '' }}>夕食</option>
                <option value="snack" {{ $meal->type == 'snack' ? 'selected' : '' }}>間食</option>
            </select>
        </div>

        <div id="ingredients-wrapper" class="form-group">
            @foreach(json_decode($meal->ingredients, true) as $index => $ingredient)
                <div class="ingredient form-group">
                    <label for="ingredient_{{ $index + 1 }}">食材 {{ $index + 1 }}:</label>
                    <input type="text" name="ingredients[{{ $index }}][name]" id="ingredient_{{ $index + 1 }}" class="form-control" value="{{ $ingredient['name'] }}" required>
                    <label for="amount_{{ $index + 1 }}">量:</label>
                    <input type="number" name="ingredients[{{ $index }}][amount]" id="amount_{{ $index + 1 }}" class="form-control" value="{{ $ingredient['amount'] }}" required>
                    <select name="ingredients[{{ $index }}][unit]" id="unit_{{ $index + 1 }}" class="form-control" required>
                        <option value="grams" {{ $ingredient['unit'] == 'grams' ? 'selected' : '' }}>グラム</option>
                        <option value="milliliters" {{ $ingredient['unit'] == 'milliliters' ? 'selected' : '' }}>ミリリットル</option>
                    </select>
                </div>
            @endforeach
        </div>

        <button type="button" id="add-ingredient" class="btn btn-secondary">食材を追加</button>
        <button type="submit" class="btn btn-primary">変更を保存</button>
    </form>

    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>

    <script>
        document.getElementById('add-ingredient').addEventListener('click', function () {
            let wrapper = document.getElementById('ingredients-wrapper');
            let count = wrapper.querySelectorAll('.ingredient').length;
            let newIngredient = document.createElement('div');
            newIngredient.classList.add('ingredient', 'form-group');
            newIngredient.innerHTML = `
                <label for="ingredient_${count + 1}">食材 ${count + 1}:</label>
                <input type="text" name="ingredients[${count}][name]" id="ingredient_${count + 1}" class="form-control" required>
                <label for="amount_${count + 1}">量:</label>
                <input type="number" name="ingredients[${count}][amount]" id="amount_${count + 1}" class="form-control" required>
                <select name="ingredients[${count}][unit]" id="unit_${count + 1}" class="form-control" required>
                    <option value="grams">グラム</option>
                    <option value="milliliters">ミリリットル</option>
                </select>
            `;
            wrapper.appendChild(newIngredient);
        });
    </script>
@endsection
