<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">




</head>


<body class="font-sans antialiased bg-gray-200">

    <div class="flex flex-col px-5 text-xl font-medium">
        <nav>
            <div class="flex content-end gap-5 items-center w-full max-md:flex-wrap max-md:max-w-full mt-5 ">
                <div class="flex-auto self-stretch my-auto text-3xl font-extrabold bg-clip-text text-red-600">
                    SPYRO
                </div>
                <div class=" flex gap-5 justify-between self-stretch my-auto mt-2 text-white text-opacity-90 ">



                    {{-- @guest --}}

                    <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">
                        <a href="{{ route('showLogin') }}" class="p-2">Login</a>
                    </div>
                    <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">
                        <a href="{{ route('showRegister') }}" class="p-2">Register</a>
                    </div>

                    {{-- @endguest --}}






                    @auth
                        {{-- @if (auth()->user()->role === 'admin') --}}
                        <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">
                            <a href="" class="p-2">Dashboard</a></div>
                        <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">
                            Community</div>

                        <div class="bg-red-800 p-2 px-8 rounded-md ">
                            <button id="logout-button">Se déconnecter</button>
                        </div>
                    @endauth
                    {{-- @endif --}}


                    {{-- @if (auth()->user()->role === 'user') --}}
                    {{-- <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">Community</div> --}}
                    {{-- <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105"><a href="{{route('admin.subscriptions.index')}}">Subscription</a></div> --}}
                    {{-- <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105"><a href="{{route('subscriptions.index')}}">Subscription</a></div> --}}


                    {{-- <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105">Program</div>
                <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105"><a href="{{route('showProducts')}}">Market place</a></div>
                <div class="pt-2 transition duration-300 ease-in-out hover:text-red-500 transform hover:scale-105"><a href="{{ route('about') }}" class="p-2">About Us</a></div>
                <div class="bg-red-800 p-2 px-8 rounded-md ">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class=" ">Logout</button>
                    </form>
                </div>
                @endif
                @endif --}}





                </div>

        </nav>
    </div>


    <div class="container mx-auto flex-1 mt-8">
        @yield('content')
    </div>

    <script>
        // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Gestion de l'événement de clic sur le bouton de déconnexion
        document.getElementById('logout-button').addEventListener('click', async function(event) {
            event.preventDefault();

            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // Inclure le jeton CSRF dans les en-têtes de la demande
                    'Authorization': 'Bearer ' + localStorage.getItem(
                            'token'
                            ) // Inclure le jeton d'authentification dans les en-têtes de la demande
                }
            });

            if (response.ok) {
                localStorage.removeItem('token'); // Supprimer le jeton d'authentification du stockage local
                alert('Déconnexion réussie !');
                // Redirect the user to another page
                window.location.href =
                "{{ route('showLogin') }}"; 
            } else {
                alert('Erreur lors de la déconnexion.');
            }



         
        });
    </script>

    </div>




</body>

</html>
