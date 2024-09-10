@extends('layouts.master')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Add Transaction</h1>

    <form action="{{ route('storeTransaction') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="transaction_type_id" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="transaction_type_id" id="transaction_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach($transactionTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md">Add Transaction</button>
    </form>
</div>
@endsection
