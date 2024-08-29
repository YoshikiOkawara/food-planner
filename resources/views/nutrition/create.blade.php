@extends('layouts.app')

@section('content')
    <h1>栄養情報の作成</h1>

    <form action="{{ route('nutrition.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="meal_type">食事タイプ:</label>
            <select name="meal_type" id="meal_type" class="form-control" required>
                <option value="breakfast">朝食</option>
                <option value="lunch">昼食</option>
                <option value="dinner">夕食</option>
                <option value="snack">間食</option>
            </select>
        </div>

        <div id="ingredients-wrapper" class="form-group">
            <div class="ingredient form-group">
                <label for="ingredient_1">食材 1:</label>
                <input type="text" name="ingredients[0][name]" id="ingredient_1" class="form-control" required>
                <label for="amount_1">量:</label>
                <input type="number" name="ingredients[0][amount]" id="amount_1" class="form-control" required>
                <select name="ingredients[0][unit]" id="unit_1" class="form-control" required>
                    <option value="grams">グラム</option>
                    <option value="milliliters">ミリリットル</option>
                </select>
            </div>
        </div>

        <button type="button" id="add-ingredient" class="btn btn-secondary">食材を追加</button>
        <button type="submit" class="btn btn-primary">栄養情報を保存</button>
    </form>

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
