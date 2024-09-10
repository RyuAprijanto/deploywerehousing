@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto py-8">

    <div class="flex flex-row justify-center">

        <!-- Products Section -->
        <div class="col-span-2">
            <table class="min-w-full bg-white border">
                <thead>
                    <h2 class="text-xl font-medium mb-4">Produk</h2>
                    <form class="flex flex-col md:flex-row gap-3 w-full md:w-auto" action="{{ url('/checkout/search') }}" method="GET" id="filterForm">
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <input type="text" name="search" placeholder="Search Product"
                                class="w-2/3 md:w-80 px-3 h-10 rounded-l border-2 border-blue-600 focus:outline-none focus:border-grey-700"
                                value="{{ request()->input('search') }}">
                            <select id="pricingType" name="type"
                                class="w-1/3 md:w-40 h-10 border-2 border-blue-600 focus:outline-none focus:border-gray-700 text-gray-700 rounded px-2 mr-2 md:px-3 py-0 md:py-1 tracking-wider"
                                onchange="document.getElementById('filterForm').submit();">
                                <option value="All" {{ request()->input('type') == 'All' ? 'selected' : '' }}>All</option>

                                @foreach ($allTypes as $type)
                                    <option value="{{ $type }}" {{ request()->input('type') == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </form>
                    <br>
                    <tr>
                        <th class="py-2 px-4 border-b">Produk</th>
                        <th class="py-2 px-4 border-b">Harga</th>
                        <th class="py-2 px-4 border-b">Stok</th>
                        <th class="py-2 px-4 border-b">Tanggal Kedaluarsa</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">Rp.{{ $product->sell_price }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->stock }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->expired_date}}</td>
                        <td class="py-2 px-4 border-b">
                            <form action="{{ route('addToCheckout', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="px-3 py-2 bg-green-500 text-white hover:bg-green-700">Tambahkan</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Checkout Section -->
        <div class="col-span-1 bg-white p-4 rounded-lg shadow-md ml-6">
            <h1 class="text-2xl font-semibold mb-6">Checkout</h1>
            <h2 class="text-xl font-medium mb-4">Rincian Transaksi</h2>
            <table class="min-w-full bg-white border mb-4">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Produk</th>
                        <th class="py-2 px-4 border-b">Kuantitas</th>
                        <th class="py-2 px-4 border-b">Harga</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>

                @if (!empty($checkoutItems))
                    <tbody>
                        @foreach ($checkoutItems as $item)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $item['product']->name }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('updateQuantity', $item['product']->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="action" value="decrease" class="px-2 py-1 bg-gray-300 hover:bg-gray-500">-</button>
                                    <span class="w-20 px-2 py-1 border rounded text-center">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action" value="increase" class="px-2 py-1 bg-gray-300 hover:bg-gray-500">+</button>
                                </form>
                            </td>
                            <td class="py-2 px-4 border-b">Rp.{{ $item['quantity'] * $item['price'] }}</td>
                            <td class="py-2 px-4 border-b">
                                <form action="{{ route('removeItem', $item['product']->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white hover:bg-red-600">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <p class="text-lg font-semibold mb-4">Total Price: Rp.{{ $totalPrice }}</p>
                @else
                    <p>No items in the checkout.</p>
                @endif
        </div>
    </div>
</div>
@endsection
