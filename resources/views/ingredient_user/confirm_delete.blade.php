<!-- resources/views/ingredient_user/confirm_delete.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Confirm Delete</h2>

    <div class="alert alert-danger">
        <strong>Warning!</strong> Are you sure you want to delete the allergy and preference for {{ $ingredientUser->user->name }}?
    </div>

    <form action="{{ route('ingredient_user.destroy', $ingredientUser->user_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="{{ route('ingredient_user.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
