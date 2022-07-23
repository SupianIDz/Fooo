<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/css/map.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex flex-col h-screen bg-slate-200">

            <nav class="bg-white sticky top-0 border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-gray-900">
                <div class="container flex flex-wrap justify-between items-center mx-auto">
                    <a href="/" class="flex items-center">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
                    </a>

                    <button data-collapse-toggle="navbar-default" type="button"
                            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="navbar-default" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                        <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                            <li>
                                <a href="{{ route('map.network') }}" class="menu {{ request()->url() === route('map.network') ? 'active' : '' }}">
                                    PETA JARINGAN
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('tubes.index') }}" class="menu {{ request()->url() === route('tubes.index') ? 'active' : '' }}">
                                    DAFTAR TUBE & KABEL
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('marker.index') }}" class="menu {{ request()->url() === route('marker.index') ? 'active' : '' }}">
                                    DAFTAR MARKER
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="p-5 h-full overflow-y-auto scrollbar scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-300">
                {{ $slot }}
            </div>

            <footer class="p-4 bg-white shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800">
                <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    © 2022 <a href="https://flowbite.com/" class="hover:underline">Mangoding ID</a> - All Rights Reserved.
                </span>
            </footer>
        </div>

        @stack('javascript')
    </body>
</html>
