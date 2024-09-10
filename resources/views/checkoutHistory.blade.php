@extends('layouts.master')

@section('title, checkout')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Checkout History</h1>

    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Product</th>
                <th class="py-2 px-4 border-b">Quantity</th>
                <th class="py-2 px-4 border-b">Total Price</th>
                <th class="py-2 px-4 border-b">Checkout Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checkouts as $checkout)
            <tr>
                <td class="py-2 px-4 border-b">{{ $checkout->product->name }}</td>
                <td class="py-2 px-4 border-b">{{ $checkout->quantity }}</td>
                <td class="py-2 px-4 border-b">{{ $checkout->total_price }}</td>
                <td class="py-2 px-4 border-b">{{ $checkout->checkout_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
