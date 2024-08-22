@extends('layouts.app')

@section('content')
    <h1>栄養価を計算</h1>

    <form action="{{ route('nutrition.calculate') }}" method="POST">
        @csrf
        <div>
            <label for="meal_type">食事タイプ:</label>
            <select name="meal_type" id="meal_type" required>
                <option value="breakfast">朝食</option>
                <option value="lunch">昼食</option>
                <option value="dinner">夕食</option>
                <option value="snack">間食</option>
            </select>
        </div>

        <div id="ingredients-wrapper">
            <div class="ingredient">
                <label for="ingredient_1">食材 1:</label>
                <input type="text" name="ingredients[0][name]" id="ingredient_1" required>
                <label for="amount_1">量:</label>
                <input type="number" name="ingredients[0][amount]" id="amount_1" required>
                <select name="ingredients[0][unit]" id="unit_1" required>
                    <option value="grams">グラム</option>
                    <option value="milliliters">ミリリットル</option>
                    <!-- 他の単位を追加できます -->
                </select>
            </div>
        </div>
        <button type="button" id="add-ingredient">食材を追加</button>
        <button type="submit">栄養価を計算</button>
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
                    <!-- 他の単位を追加できます -->
                </select>
            `;
            wrapper.appendChild(newIngredient);
        });
    </script>
@endsection
