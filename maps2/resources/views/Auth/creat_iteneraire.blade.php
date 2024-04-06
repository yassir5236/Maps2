

@extends('layout')
@section('content')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
</head>

<body>
    <!-- Formulaire d'Inscription -->
    <form id="register-form" class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xs mx-auto">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nom</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Nom" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">E-mail</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="E-mail" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Mot de passe</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Mot de passe" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">S'inscrire</button>
        </div>
    </form>

     <!-- Formulaire de Connexion -->
        <form id="login-form" class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xs mx-auto">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="login-email">E-mail</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="login-email" type="email" placeholder="E-mail" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="login-password">Mot de passe</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="login-password" type="password" placeholder="Mot de passe" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Se connecter</button>
            </div>
        </form>

    <button id="logout-button">Se déconnecter</button>


    <script>
        
        // Gestion de l'événement de soumission du formulaire d'inscription
        document.getElementById('register-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken // Inclure le jeton CSRF dans les en-têtes de la demande
                },
                body: JSON.stringify({
                    name,
                    email,
                    password
                })
            });

            if (response.ok) {
                alert('Compte créé avec succès !');
                // Rediriger l'utilisateur vers une autre page
            } else {
                const errorData = await response.json();
                alert('Erreur lors de la création du compte : ' + errorData.message);
            }
        });

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
                // Rediriger l'utilisateur vers une autre page
            } else {
                alert('Adresse e-mail ou mot de passe incorrect.');
            }
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


        // Gestion de l'événement de clic sur le bouton de déconnexion
        document.getElementById('logout-button').addEventListener('click', async function(event) {
            event.preventDefault();

            const response = await fetch('/api/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken, // Inclure le jeton CSRF dans les en-têtes de la demande
                    'Authorization': 'Bearer ' + localStorage.getItem(
                        'token') // Inclure le jeton d'authentification dans les en-têtes de la demande
                }
            });

            if (response.ok) {
                localStorage.removeItem('token'); // Supprimer le jeton d'authentification du stockage local
                alert('Déconnexion réussie !');
                // Rediriger l'utilisateur vers une autre page si nécessaire
            } else {
                alert('Erreur lors de la déconnexion.');
            }
        });
    </script>








</body>

</html>
@endsection