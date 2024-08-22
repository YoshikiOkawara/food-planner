@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>今日の栄養素摂取量</h2>

    <table class="table">
        <thead>
            <tr>
                <th>栄養素</th>
                <th>合計摂取量</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>カロリー</td>
                <td>{{ number_format($totals['calories'], 2) }} kcal</td>
            </tr>
            <tr>
                <td>炭水化物</td>
                <td>{{ number_format($totals['carbohydrates'], 2) }} g</td>
            </tr>
            <tr>
                <td>タンパク質</td>
                <td>{{ number_format($totals['protein'], 2) }} g</td>
            </tr>
            <tr>
                <td>脂質</td>
                <td>{{ number_format($totals['fat'], 2) }} g</td>
            </tr>
            <tr>
                <td>ビタミン</td>
                <td>{{ number_format($totals['vitamin'], 2) }} mg</td>
            </tr>
            <tr>
                <td>ミネラル</td>
                <td>{{ number_format($totals['mineral'], 2) }} mg</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
