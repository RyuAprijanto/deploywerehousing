@extends('layouts.master')

@section('title, checkout')

@section('content')
<div class="container">
    <h1 class="text-center font-semibold mt-2 text-3xl">All Checkouts</h1>
    <ul class="list-group">
        {{-- @foreach($checkouts as $checkout)
            <li class="list-group-item">
                <strong>Checkout Date:</strong> {{ $checkout->created_at->format('d M Y, H:i:s') }} <br>
                <strong>Total Products:</strong> {{ $checkout->checkoutItems->sum('quantity') }} <br>
                <strong>Total Price:</strong> Rp.{{ $checkout->checkoutItems->sum(function($item) { return $item->quantity * $item->price; }) }} <br>
                <a href="{{ route('checkoutsDetails', $checkout->id) }}" class="btn btn-primary mt-2">View Details</a>
            </li>
        @endforeach --}}

            @if ($checkouts->isNotEmpty())
                <div class="-mx-4 sm:-mx-8  sm:px-8 py-4 overflow-x-auto flex justify-center mt-4">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
							<tr>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Tanggal Checkout
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Total Produk
								</th>
                                <th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Harga Total
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
								</th>
							</tr>
						</thead>
                @foreach ($checkouts as $checkout)
                <tbody>
						<tr>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<div class="flex items-center">
									<div class="ml-3">
										<p class="text-gray-900 whitespace-no-wrap">
											{{ $checkout->created_at->format('d M Y, H:i:s') }}
										</p>
									</div>
								</div>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
								<p class="text-gray-900 whitespace-no-wrap">{{ $checkout->checkoutItems->sum('quantity') }}</p>
							</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
								<p class="text-gray-900 whitespace-no-wrap">{{ $checkout->checkoutItems->sum(function($item) { return $item->quantity * $item->price; }) }}</p>
							</td>
							<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
								<span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                        <a href="{{ route('checkoutsDetails', $checkout->id) }}" class="btn btn-primary mx-2 my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail barang </a>
								</span>
							</td>
					    </tr>
                    </tbody>
                @endforeach
            </div>
        </div>
    </table>
    @else
        <p class="text-center text-3xl font-medium">Belum ada transaksi</p>
    @endif
    </ul>
</div>
@endsection
