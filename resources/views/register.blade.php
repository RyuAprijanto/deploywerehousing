<!doctype html>
<html>
     <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    </head>

     <body class="flex flex-col h-screen justify-center items-center">
        <div class="mx-2 my-0 bg-black text-blue-700 text-3xl font-bold rounded-lg text-center animate-pulse">
                WereHousing
            </div>

        <div class="w-1/2 h-screen items-center justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Daftar Akun baru</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form enctype="multipart/form-data"action="{{ route('register') }}" method="POST" class="mb-5">
                    @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat Email</label>
                    <div class="mt-2">
                        <input id="exampleInputEmail1" name="inputEmail" type="email" placeholder=" Masukkan Alamat Email" autocomplete="email" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <br>
                <div>
                    <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nama Pengguna</label>
                    <div class="mt-2">
                        <input id="exampleInputUsername1" name="inputUsername" type="text" placeholder=" Masukkan Nama Anda" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <br>
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Kata Sandi</label>
                    </div>
                    <div class="mt-2">
                        <input id="exampleInputPassword1" name="inputPassword" type="password" placeholder=" Masukkan Kata Sandi" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                {{-- <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Re-Enter Your Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div> --}}

                <br>
                <div class="mb-2">
                    {{-- ERROR MESSAGE --}}
                    @if($errors->any())
                      <p class="text-danger">{{ $errors->first() }}</p>
                    @endif
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Daftar</button>
                </div>
                </form>

                <p class="mt-10 text-center text-sm text-gray-500">
                    Sudah Punya Akun?
                    <a href="{{ route('index_login') }}" class="font-semibold leading-6 text-blue-600 hover:text-indigo-500">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>
