<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<html>
<body>
@include('layouts.navbar')

<main>
    <div class="min-h-screen flex flex-col pb-10">
        <div class="flex-grow mb-14">
            @yield('content')
        </div>
    </div>
</main>

@include('layouts.footer')

</body>
