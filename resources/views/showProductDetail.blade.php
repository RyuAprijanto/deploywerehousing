@extends('layouts.master')

@section('document_title', 'Product Details')

@section('content')
<div class="flex justify-center">
    <div class="block max-w-[24rem] rounded-lg text-surface border-2 border-blue-900">
        <div class="relative overflow-hidden bg-cover bg-no-repeat border border-gray-700 rounded-lg">
            <img src="{{ asset('storage/images/' . $product->image) }}" alt="Image Not Found" class="img-fluid img-thumbnail">
        </div>
        <div class="p-6 text-wrap bg-blue-100 border rounded-lg border-gray-600">
            <h5 class="mb-2 text-xl font-medium leading-tight shadow-md">
                {{ $product->name }}
            </h5>
            <p class="mt-2 text-base text-wrap shadow-md">
                {{ $product->description }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Stok: {{ $product->stock }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Kategori: {{ $product->type_name }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Harga Beli: Rp {{ number_format($product->buy_price, 0, ',', '.') }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Harga Jual: Rp {{ number_format($product->sell_price, 0, ',', '.') }}
            </p>
            <p class="mt-2 text-sm font-medium leading-tight shadow-md border border-blue-900">
                Tanggal Kedaluwarsa: {{ $product->expired_date ? \Carbon\Carbon::parse($product->expired_date)->format('d-m-Y') : '-' }}
            </p>
        </div>
        <div class="bg-blue-100 border rounded-lg border-gray-600">
            <ul class="w-full border-t-2 border-gray-900">
                <div class="w-full flex justify-center px-6 py-3">
                    <a type="button" href="{{ route('editProduct', ['id' => $product->id]) }}" class="text-white bg-yellow-500 hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 text-center">
                        Ubah Produk
                    </a>
                </div>
                <li class="w-full">
                    <div class="flex justify-center m-5">
                        <button id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="mt-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center" type="button">
                            Hapus Produk
                        </button>
                    </div>
                </li>
            </ul>
            <div id="deleteModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin? Data yang telah dihapus tidak dapat dikembalikan</p>
                        <div class="flex justify-center items-center space-x-4">
                            <button data-modal-toggle="deleteModal" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10">
                                Kembali
                            </button>
                            <form class="flex justify-center" action="{{ route('deleteProduct', ['id' => $product->id]) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center">Hapus Produk</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full flex justify-center px-6 py-3">
                <a type="button" href="{{ route('index_home') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

