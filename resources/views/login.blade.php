<!doctype html>
<html>
    <title>Werehousing</title>
    <head>
    <meta charset="utf-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    </head>
    <body class="flex w-screen h-screen justify-center items-center">
        <div class="md:w-2/3 sm:w-full h-screen items-center justify-center py-12 lg:px-9 sm:px-9">
            <div class="mx-2 my-0 bg-black text-blue-700 text-3xl font-bold rounded-lg text-center animate-pulse">
                WereHousing
            </div>
    
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Masuk Ke Akun</h2>
            </div>
    
            <div class="mt-10 sm:mx-auto sm:w-screen sm:max-w-sm">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block lg:text-sm sm:text-xs font-medium leading-6 text-gray-900">Alamat Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" placeholder=" Masukkan Alamat Email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                    <br>
                    <div>
                        <div class="lg:flex">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Kata Sandi</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder=" Masukkan Kata Sandi" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                        <div class="text-sm mt-2">
                            <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500 text-sm">Lupa Kata Sandi?</a>
                        </div>
                    </div>
                    <br>
                    
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                    </div>
                </form>
                @if ($errors->any())
                    {{ $errors }}
                @endif
                <p class="mt-10 text-center text-sm text-gray-500">
                    Belum Punya Akun?   
                    <a href="{{ route('index_register') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                        Daftar
                    </a>
                </p>
            </div>
        </div>
    </body>
    
</html>
