@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<div class="w-full flex flex-col md:flex-row items-center justify-center h-auto md:h-36 bg-blue-300 p-4 md:p-0">
    <div class="flex flex-col md:flex-row items-center justify-center py-2 w-full">
        <form class="flex flex-col md:flex-row gap-3 w-full md:w-auto" action="{{ url('/main/search') }}" method="GET">
            <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                <input type="text" name="search" placeholder="Search Product"
                    class="w-2/3 md:w-80 px-3 h-10 rounded-l border-2 border-blue-600 focus:outline-none focus:border-grey-700"
                    value="{{ request()->input('search') }}">
                <select id="pricingType" name="type"
                    class="w-1/3 md:w-40 h-10 border-2 border-blue-600 focus:outline-none focus:border-gray-700 text-gray-700 rounded px-2 mr-2 md:px-3 py-0 md:py-1 tracking-wider">
                    <option value="All" {{ request()->input('type') == 'All' ? 'selected' : '' }}>All</option>
                    @foreach ($allTypes as $type)
                        <option value="{{ $type }}" {{ request()->input('type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <div class="flex flex-col md:flex-row gap-2 md:gap-3 mt-3 md:mt-0 w-full md:w-auto">
            <a href="{{ route('createProduct') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-full md:w-auto">
                Produk Baru
            </a>
            <div class="flex flex-row gap-2 md:gap-3 w-full md:w-auto">
                <a href="{{ route('viewCheckout') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Checkout
                </a>
                <a href="{{ route('restockPage') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Restock
                </a>
                <a href="{{ route('viewCheckouts') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 w-1/2 md:w-auto">
                    Riwayat Checkout
                </a>
            </div>
        </div>
    </div>
</div>

@foreach ($products as $product)
    <div class="text-center">
        @if ($product->stock < 10)
            <h5 class="mb-2 lg:text-lg sm:text-base font-bold tracking-tight text-red-600">Stok barang ini: "{{ $product->name }}" sisa: {{ $product->stock }}, segera pesan.</h5>
        @endif
    </div>
@endforeach

@if ($products->isNotEmpty())
    <div class="-mx-4 sm:-mx-8 sm:px-8 py-4 overflow-x-auto flex justify-center">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('viewPageSearch', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">
                                Nama Barang
                                @if (request('sort_by') == 'name')
                                    @if (request('sort_order') == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('viewPageSearch', array_merge(request()->query(), ['sort_by' => 'buy_price', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">
                                Harga Beli
                                @if (request('sort_by') == 'buy_price')
                                    @if (request('sort_order') == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('viewPageSearch', array_merge(request()->query(), ['sort_by' => 'sell_price', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">
                                Harga Jual
                                @if (request('sort_by') == 'sell_price')
                                    @if (request('sort_order') == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('viewPageSearch', array_merge(request()->query(), ['sort_by' => 'expired_date', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">
                                Kedaluarsa
                                @if (request('sort_by') == 'expired_date')
                                    @if (request('sort_order') == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="text-center px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('viewPageSearch', array_merge(request()->query(), ['sort_by' => 'stock', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}">
                                Stok
                                @if (request('sort_by') == 'stock')
                                    @if (request('sort_order') == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full"
                                            src="{{ asset('storage/images/' . $product->image) }}"
                                            alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            {{ $product->name }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $product->buy_price }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $product->sell_price }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if ($product->expired_date !== null)
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ $product->expired_date ? \Carbon\Carbon::parse($product->expired_date)->format('d-m-Y') : '-' }}
                                    </p>
                                @else
                                    <p class="text-gray-900 whitespace-no-wrap text-center"> - </p>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <form action="{{ route('updateStock', ['id' => $product->id]) }}" method="POST" class="flex items-center">
                                        @csrf
                                        <button type="submit" name="action" value="decrease" class="bg-red-500 text-white px-1 rounded">-</button>
                                        <div class="w-12 text-center mx-2 border border-gray-300 rounded">{{ $product->stock }}</div>
                                        <button type="submit" name="action" value="increase" class="bg-green-500 text-white px-1 rounded">+</button>
                                    </form>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                    <a href="{{ route('productDetail', ['id' => $product->id]) }}" class="btn btn-primary mx-2 my-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Detail barang </a>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 w-full flex justify-center">
        {{ $products->links() }}
    </div>
@else
    <p class="text-center text-3xl font-medium">Produk tidak ditemukan</p>
    <a href="{{ route('createProduct') }}" class="mx-2 my-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center animate-pulse">
        Tambahkan Barang
    </a>
@endif
<script>
    document.getElementById('pricingType').addEventListener('change', function() {
        this.form.submit();
    });
</script>
@endsection







