<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="flex flex-col h-screen select-none">

            <section class="my-auto">
                <div class="w-full lg:w-4/12 px-4 mx-auto pt-6">
                    <div class="relative bg-white flex flex-col min-w-0 break-words w-full mb-6 shadow-xl rounded-lg border">
                        <div class="rounded-t mb-0 px-6 py-6">
                            <div class="flex justify-center items-center space-x-3 text-center mb-3">
                                <img src="https://flowbite.com/docs/images/logo.svg" alt="">
                                <h6 class="text-blueGray-500 text-sm font-bold">
                                    JARINGAN KABEL
                                </h6>
                            </div>
                            <hr class="mt-6 border-b-1 border-blueGray-300">
                        </div>

                        <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                            @if($errors->any())
                            @foreach($errors->all() as $error)
                            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                                <span class="font-medium">{{ $error }}</span>
                            </div>

                            @endforeach
                            @endif

                            <form method="POST" action="{{ route('auth.login') }}">
                                @csrf
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Email</label>
                                    <input type="email" name="email" class="form" placeholder="Email">
                                </div>
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" for="grid-password">Password</label>
                                    <input type="password" name="password" class="form" placeholder="Password">
                                </div>
                                <div class="text-center mt-6">
                                    <button
                                        class="bg-blue-600 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150"
                                        type="submit"> SIGN IN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            @stack('javascript')
    </body>
</html>
