<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                User Details
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Allergy:</strong> {{ $user->allergy }}</p>
                <p><strong>Preference:</strong> {{ $user->preference }}</p>
            </div>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-primary mt-3">Back to Users List</a>
    </div>
</x-app-layout>
