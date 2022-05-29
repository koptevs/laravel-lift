<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Liftu reģistrs</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?v=<?=time()?>" rel="stylesheet">

    <style>
        body {
            /*font-family: 'Nunito', sans-serif;*/
        }
    </style>
</head>
<body class="antialiased">

<nav>
    <div class="bg-blue-900">
        <div class="container max-w-none w-auto py-3 px-12 flex justify-between items-center">
            <a class="text-xl lg:text-2xl font-bold text-white tracking-wide" href="/">
                LIFTU REĢISTRS
            </a>

            <div>
                @if (Route::has('login'))
                    <ul class="inline-flex">
                        @auth
                            <li><a href="{{ url('/dashboard') }}" class="px-4 font-bold">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-200 px-4 hover:text-white">Log in</a>
                            </li>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="text-gray-200 px-4 hover:text-white">Register</a>
                            @endif

                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </div>
</nav>


<div class="container max-w-none w-auto p-12 -mt-14 lg:-mt-16 lg:min-h-screen">
    <section class="container min-h-none  grid lg:grid-cols-2 gap-16 items-center mt-14 ">
        <img class="hidden lg:inline"
             src="https://res.cloudinary.com/thirus/image/upload/v1634585194/images/details-1_e7ojp9.svg" alt=""/>
        <div>
            <h1 class="text-4xl mb-4 font-bold">
                Liftu pārbaudes datuma pārbaude
            </h1>
                <p class="text-xl">Pārliecinieties, vai jūsu lifts ir izgājis ikgadējo tehnisko apskati. <br> Varat to pārbaudīt pēc lifta reģistrācijas numura, vai pēc adreses.</p>

            {{--      FORM      --}}

            <div class="w-full max-w-sm p-4">
                <form class="bg-white  rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="regnr">
                            Lifta reģistrācijas numurs
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="regnr" type="text" placeholder="4CL223322">
                    </div>
                    <div class="mb-8">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                            Adrese
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="address" type="text" placeholder="Brīvības iela 300">
                    </div>
                    <div class="flex items-center justify-between">
                        <button onclick="alert('Funkcionalitāte vēl izstrādē')" class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Pārbaudīt
                        </button>

                    </div>
                </form>
                <p class="text-center text-gray-500 text-xs">
                    &copy;2022 SIA Best Lifts.
                </p>
            </div>

            {{--      FORM      --}}


        </div>
        <img class="lg:hidden w-80 mx-auto"
             src="https://res.cloudinary.com/thirus/image/upload/v1634585194/images/details-1_e7ojp9.svg" alt=""/>
    </section>
</div>
</body>
</html>
