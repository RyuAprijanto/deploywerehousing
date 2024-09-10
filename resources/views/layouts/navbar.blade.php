<body class="bg-blue-100">
    <nav class="bg-blue-400 w-full border-b border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('index_home') }}" class="flex space-x-3">
                <span class="text-4xl text-gray-700 font-semibold whitespace-nowrap">WEREHOUSING</span>
            </a>

            <!-- Hamburger Menu -->
            <button class="block lg:hidden px-2 text-gray-600" id="navbar-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <!-- Navbar Items -->
            <div class="hidden w-full lg:flex lg:w-auto border-gray-700 border rounded-lg" id="navbar-menu">
                <ul class="font-medium flex flex-col lg:flex-row lg:space-x-4 p-1 border border-gray-100 rounded-lg bg-white lg:bg-gray-500 lg:border-0 lg:rounded-none">
                    <!-- History Dropdown -->
                    {{-- <li class="relative">
                        <button id="historyDropdown" data-dropdown-toggle="historyDropdownMenu" class="block py-2 px-2 text-gray-600 rounded hover:bg-gray-700 hover:text-white">
                            History
                        </button>
                        <div id="historyDropdownMenu" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                            <ul class="py-1 text-sm text-gray-700" aria-labelledby="historyDropdown">
                                <li>
                                    <a href="{{ route('showHistory') }}" class="block py-2 px-4 hover:bg-gray-700 hover:text-white">User History</a>
                                </li>
                                <li>
                                    <a href="{{ route('viewCheckouts') }}" class="block py-2 px-4 hover:bg-gray-700 hover:text-white">Checkout History</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    <li>
                        <a href="{{ route('viewTransactions') }}" class="block py-2 px-2 text-gray-600 rounded hover:bg-gray-700 hover:text-white" aria-current="page">Rincian Transaksi</a>
                    </li>
                    <!-- Welcome Message -->
                    <li class="ml-auto">
                        <span class="block py-2 px-2 text-gray-600 rounded">Welcome, {{ Auth::user()->username }}</span>
                    </li>

                    <!-- Settings Dropdown -->
                    <li class="relative">
                        <button id="settingsDropdown" data-dropdown-toggle="settingsDropdownMenu" class="block py-2 px-2 text-gray-600 rounded hover:bg-gray-700 hover:text-white">
                            Settings
                        </button>
                        <div id="settingsDropdownMenu" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                            <ul class="py-1 text-sm text-gray-700" aria-labelledby="settingsDropdown">
                                <li>
                                    <a href="{{ route('showProfile') }}" class="block py-2 px-4 hover:bg-gray-700 hover:text-white">Profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full text-left py-2 px-4 hover:bg-gray-700 hover:text-white">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
        // JavaScript to handle the toggling of the navbar menu on mobile devices
        document.getElementById('navbar-toggle').addEventListener('click', function() {
            var navbarMenu = document.getElementById('navbar-menu');
            if (navbarMenu.classList.contains('hidden')) {
                navbarMenu.classList.remove('hidden');
            } else {
                navbarMenu.classList.add('hidden');
            }
        });
    </script>
</body>


