<!-- resources/views/ingredient_user/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Allergy and Preference Details</h2>

    <div class="card">
        <div class="card-header">
            {{ $ingredientUser->user->name }}'s Details
        </div>
        <div class="card-body">
            <p><strong>Allergy:</strong> {{ $ingredientUser->allergy }}</p>
            <p><strong>Preference:</strong> {{ $ingredientUser->preference }}</p>
        </div>
    </div>
</div>
@endsection
