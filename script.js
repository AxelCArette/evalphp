document.addEventListener('DOMContentLoaded', function () {
    const likeButtons = document.querySelectorAll('form[name="like"] button');

    likeButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const form = event.target.closest('form');

            // Envoyer le formulaire via AJAX
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
            })
            .then(response => {
                if (response.ok) {
                    // Mettre à jour le style du bouton si le like est réussi
                    button.classList.toggle('liked');
                }
            })
            .catch(error => console.error('Erreur lors de l\'envoi du formulaire', error));
        });
    });
});

