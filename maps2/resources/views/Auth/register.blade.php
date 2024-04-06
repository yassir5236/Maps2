

@extends('layout')
@section('content')


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




    <script>
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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

      



      
    </script>

@endsection