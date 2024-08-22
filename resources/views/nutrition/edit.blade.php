@extends('layouts.app')

@section('content')
    <h1>{{ $meal->type }}の編集</h1>

    <form action="{{ route('nutrition.update', $meal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div id="ingredients-wrapper">
            @foreach($ingredients as $index => $ingredient)
                <div class="ingredient">
                    <label for="ingredient_{{ $index + 1 }}">食材 {{ $index + 1 }}:</label>
                    <input type="text" name="ingredients[{{ $index }}][name]" id="ingredient_{{ $index + 1 }}" value="{{ $ingredient['name'] }}" required>
                    <label for="amount_{{ $index + 1 }}">量:</label>
                    <input type="number" name="ingredients[{{ $index }}][amount]" id="amount_{{ $index + 1 }}" value="{{ $ingredient['amount'] }}" required>
                    <select name="ingredients[{{ $index }}][unit]" id="unit_{{ $index + 1 }}" required>
                        <option value="grams" {{ $ingredient['unit'] == 'grams' ? 'selected' : '' }}>グラム</option>
                        <option value="milliliters" {{ $ingredient['unit'] == 'milliliters' ? 'selected' : '' }}>ミリリットル</option>
                    </select>
                </div>
            @endforeach
        </div>
        <button type="button" id="add-ingredient">食材を追加</button>
        <button type="submit">更新</button>
    </form>

    <script>
        document.getElementById('add-ingredient').addEventListener('click', function () {
            let wrapper = document.getElementById('ingredients-wrapper');
            let count = wrapper.querySelectorAll('.ingredient').length;
            let newIngredient = document.createElement('div');
            newIngredient.classList.add('ingredient');
            newIngredient.innerHTML = `
                <label for="ingredient_${count + 1}">食材 ${count + 1}:</label>
                <input type="text" name="ingredients[${count}][name]" id="ingredient_${count + 1}" required>
                <label for="amount_${count + 1}">量:</label>
                <input type="number" name="ingredients[${count}][amount]" id="amount_${count + 1}" required>
                <select name="ingredients[${count}][unit]" id="unit_${count + 1}" required>
                    <option value="grams">グラム</option>
                    <option value="milliliters">ミリリットル</option>
                </select>
            `;
            wrapper.appendChild(newIngredient);
        });
    </script>
@endsection
