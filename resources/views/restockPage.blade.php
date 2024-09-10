@extends('layouts.master')
@section('title, Restock')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Restock Products</h1>

    <form action="{{ route('processRestock') }}" method="POST">
        @csrf
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Select</th>
                    <th class="py-2 px-4 border-b">Product Name</th>
                    <th class="py-2 px-4 border-b">Current Stock</th>
                    <th class="py-2 px-4 border-b">Expired Date</th>
                    <th class="py-2 px-4 border-b">Quantity to Restock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="py-2 px-4 border-b">
                        <input type="checkbox" name="products[]" value="{{ $product->id }}">
                    </td>
                    <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                    <td class="py-2 px-4 border-b">{{ $product->expired_date }}</td>
                    <td class="py-2 px-4 border-b">
                        <input type="number" name="restock_qty[{{ $product->id }}]" min="1" class="w-full px-3 h-10 rounded border-2 border-gray-300 focus:outline-none focus:border-gray-700">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white font-semibold hover:bg-blue-700">Restock Selected Products</button>
    </form>
</div>
@endsection
