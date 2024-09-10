@extends('layouts.master')

@section('title, checkout')

@section('content')

<div class="container">
    {{-- <h1>Checkout Details</h1>
    <p><strong>Checkout Date:</strong> {{ $checkout->created_at->format('d M Y, H:i:s') }}</p>
    <p><strong>Total Products:</strong> {{ $checkout->checkoutItems->sum('quantity') }}</p>
    <p><strong>Total Price:</strong> Rp.{{ $checkout->checkoutItems->sum(function($item) { return $item->quantity * $item->price; }) }}</p>

    <h2>Products</h2> --}}
    {{-- <ul class="list-group">
        @foreach($checkout->checkoutItems as $item)
            <li class="list-group-item">
                <strong>{{ $item->product->name }}</strong> <br>
                Quantity: {{ $item->quantity }} <br>
                Price: Rp.{{ $item->price }} <br>
                Total: Rp.{{ $item->quantity * $item->price }}
            </li>
        @endforeach
        <div>
    </ul> --}}
    <div class="flex h-screen w-full mt-4 items-start justify-center">
        <div class="w-1/2 rounded bg-gray-50 px-6 pt-4 shadow-lg mt-6">

                <div class="flex flex-col gap-3 border-b py-6 ">
                    <p class="flex justify-between">
                        <span class="text-gray-400">Tanggal Transaksi:</span>
                        <span>{{ $checkout->created_at->format('d M Y, H:i:s') }}</span>
                    </p>
                    <p class="flex justify-between">
                        <span class="text-gray-400">Total Produk:</span>
                        <span>{{ $checkout->checkoutItems->sum('quantity') }}</span>
                    </p>
                    <p class="flex justify-between">
                        <span class="text-gray-400">Total Harga:</span>
                        <span>Rp.{{ $checkout->checkoutItems->sum(function($item) { return $item->quantity * $item->price; }) }}</span>
                    </p>
                </div>
                <div class="-mx-4 mt-8 flow-root sm:mx-0">
                <table class="min-w-full">
                    <colgroup>
                        <col class="w-full">
                        <col class="w-1/6">
                        <col class="w-1/6">
                        <col class="w-1/6">
                    </colgroup>
                    <thead class="border-b border-gray-300 text-gray-900">
                        <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Nama Barang</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Harga Satuan</th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Jumlah</th>
                        <th scope="col" class="py-3.5 pl-3 pr-4 text-center text-sm font-semibold text-gray-900 sm:pr-0">Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr class="border-b border-gray-200">
                        <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div class="font-medium text-gray-900">E-commerce Platform</div>
                            <div class="mt-1 truncate text-gray-500">Laravel based e-commerce platform.</div>
                        </td>
                        <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">500.0</td>
                        <td class="hidden px-3 py-5 text-right text-sm text-gray-500 sm:table-cell">$100.00</td>
                        <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$5,000.00</td>
                        <td class="py-5 pl-3 pr-4 text-right text-sm text-gray-500 sm:pr-0">$12</td>
                        </tr> --}}
                        @foreach ($checkout->checkoutItems as $item)
                             <tr class="border-b border-gray-200">
                        <td class="max-w-0 py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div class="font-medium text-gray-900">{{ $item->product->name }}</div>
                        </td>
                        <td class="px-3 py-5 text-center text-sm text-gray-500 sm:table-cell">{{ $item->price }}</td>
                        <td class="px-3 py-5 text-center text-sm text-gray-500 sm:table-cell">{{ $item->quantity }}</td>
                        <td class="py-5 pl-3 pr-4 text-center text-sm text-gray-500 sm:pr-0">Rp.{{ $item->quantity * $item->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" border-b border border-dashed"></div>
            </div>
            <div>
                <a>
            </div>
        </div>
</div>
@endsection
