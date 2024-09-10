@extends('layouts.master')

@section('document_title', 'Add Product')

@section('content')
<div class="container flex h-screen w-screen justify-center mb-10">
    <div id="additem" class="justify-center items-center w-screen h-full m-4">
        <div class="container flex justify-center h-auto p-4 w-full max-w-2xl mb-10">
            <div class="bg-slate-500 rounded-lg shadow-md">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Produk Baru
                    </h3>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <form class="space-y-6" action="{{ route('insertProduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="itemname" class="block text-sm font-medium leading-6 text-gray-900">Nama Produk</label>
                            <input id="name" name="name" value="{{ old('name') }}" type="text" required class="form-group block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @if ($errors->has('name'))
                                <span class="text-red-500 text-sm">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                            <div class="grid md:grid-cols-2 md:gap-6">
                                <div class="z-0 w-full my-3 group">
                                    <label for="type" required class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Kategori Produk</label>
                                    <select id="type" name="type_id" class="form-group block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($types as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="z-0 w-full my-3 group">
                                    <label for="enable_new_type" required class="text-sm font-medium leading-6 text-gray-900">Kategori Baru</label>
                                    <input type="checkbox" id="enable_new_type" name="enable_new_type" class="form-group rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 block">
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="new_type" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Kategori Baru</label>
                                    <input id="new_type" name="new_type" value="{{ old('new_type') }}" type="text" class="form-group block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Add new type" disabled>
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="itemqty" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Jumlah Produk</label>
                                    <input id="stock" name="stock" value="{{ old('stock') }}" type="number" required class="form-group block min-w-9 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="buy_price" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Harga Beli</label>
                                    <input id="buy_price" name="buy_price" value="{{ old('buy_price') }}" type="number" required class="form-group block min-w-9 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <label for="sell_price" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Harga Jual</label>
                                    <input id="sell_price" name="sell_price" value="{{ old('sell_price') }}" type="number" required class="form-group block min-w-9 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="z-0 w-full my-3 group">
                                    <input type="checkbox" id="has_expiry_date" name="has_expiry_date" class="form-group mr-2">
                                    <label for="has_expiry_date" class="text-sm font-medium leading-6 text-gray-900">Tanggal Kedaluarsa</label>
                                </div>
                                <div id="expiry_date_container" class="z-0 w-full my-3 group hidden">
                                    <label for="expired_date" class="columns-2 justify-start text-sm font-medium leading-6 text-gray-900">Tanggal Kedaluwarsa</label>
                                    <input id="expired_date" name="expired_date" type="date" value="{{ old('expired_date') }}" class="form-group block rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <label for="description" class="form-control block text-sm font-medium leading-6 text-gray-900">Deskripsi Produk</label>
                            <div class="max-w-sm mx-auto justify-start">
                                <textarea id="description" required name="description" rows="4" class="form-group block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Konten Post">{{ old('description') }}</textarea>
                            </div>
                            <label required class="form-control block mb-2 text-sm font-medium text-gray-900" for="itempic">Gambar Produk</label>
                            <input name="image" class="form-group block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image_path" type="file">
                            <p class="mt-1 text-sm" id="image">SVG, PNG, JPG or GIF.</p>
                        </div>
                        <button type="submit" class="form-control text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Produk</button>
                        <a href="{{ route('index_home') }}" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const enableNewTypeCheckbox = document.getElementById('enable_new_type');
    const newTypeInput = document.getElementById('new_type');
    const typeSelect = document.getElementById('type');
    const hasExpiryDateCheckbox = document.getElementById('has_expiry_date');
    const expiryDateContainer = document.getElementById('expiry_date_container');

    enableNewTypeCheckbox.addEventListener('change', function() {
        if (this.checked) {
            newTypeInput.disabled = false;
            typeSelect.disabled = true;
        } else {
            newTypeInput.disabled = true;
            typeSelect.disabled = false;
        }
    });

    hasExpiryDateCheckbox.addEventListener('change', function() {
        if (this.checked) {
            expiryDateContainer.classList.remove('hidden');
        } else {
            expiryDateContainer.classList.add('hidden');
        }
    });

    // Ensure new_type field is cleared if the checkbox is unchecked
    enableNewTypeCheckbox.addEventListener('change', function() {
        if (!this.checked) {
            newTypeInput.value = '';
        }
    });

    // Ensure expired_date field is cleared if the checkbox is unchecked
    hasExpiryDateCheckbox.addEventListener('change', function() {
        if (!this.checked) {
            document.getElementById('expired_date').value = '';
        }
    });
});

</script>
@endsection


