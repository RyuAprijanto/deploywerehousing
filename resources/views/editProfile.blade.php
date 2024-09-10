@extends('layouts.master')

@section('document_title', 'Profile Edit')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Edit Profile</h2>
    <div class="bg-white shadow-md rounded-lg p-4">
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('updateProfile') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="border rounded w-full py-2 px-3" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">New Password:</label>
                <input type="password" name="password" id="password" class="border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="border rounded w-full py-2 px-3">
            </div>
            <div>
                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    Save
                </button>
                <a href="{{ route('showProfile') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
    