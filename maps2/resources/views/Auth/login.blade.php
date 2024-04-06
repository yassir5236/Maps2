@extends('layout')
@section('content')
    <!-- Formulaire de Connexion -->
    <form id="login-form" class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xs mx-auto">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="login-email">E-mail</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="login-email" type="email" placeholder="E-mail" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="login-password">Mot de passe</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                id="login-password" type="password" placeholder="Mot de passe" required>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">Se connecter</button>
        </div>
    </form>



    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Gestion de l'événement de soumission du formulaire de connexion
        document.getElementById('login-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Inclure le jeton CSRF dans les en-têtes de la demande
                },
                body: JSON.stringify({
                    email,
                    password
                })
            });

            if (response.ok) {
                const tokenData = await response.json();
                localStorage.setItem('token', tokenData.token);
                alert('Connexion réussie !');
                // Redirect the user to another page
                window.location.href =
                "{{ route('homeUser') }}"; // Replace '/another-page' with your desired page route
            } else {
                alert('Adresse e-mail ou mot de passe incorrect.');
            }
        });
    </script>
@endsection
