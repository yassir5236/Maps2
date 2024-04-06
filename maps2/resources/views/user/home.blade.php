@extends('layout')

@section('content')
    <div class="  max-w-7xl mx-auto p-6 lg:p-8">


        <div class="mt-16 flex justify-center text-gray-600 text-4xl font-bold">WELCOME TO User home</div>


    </div>


    <script>
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
                            'token'
                            ) // Inclure le jeton d'authentification dans les en-têtes de la demande
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
@endsection


