document.addEventListener('DOMContentLoaded', function () {
    var dropdownBtn = document.getElementById('dropdownBtn');
    var dropdownContent = document.getElementById('dropdownContent');

    dropdownBtn.addEventListener('click', function () {
        dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
    });

    // Chiudi il dropdown se l'utente clicca fuori dall'area del dropdown
    window.addEventListener('click', function (event) {
        if (!event.target.matches('#dropdownBtn')) {
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
    });
});

function deleteAnnuncio(annuncioId) {
    if (confirm("Sei sicuro di voler eliminare questo annuncio?")) {
        $.ajax({
            url: '/annunci/' + annuncioId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                alert(response.message); // Mostra un messaggio di successo
                location.reload(); // Aggiorna la pagina dopo l'eliminazione
            },
            error: function(error) {
                console.error('Errore durante l\'eliminazione dell\'annuncio:', error);
                alert('Si è verificato un errore durante l\'eliminazione dell\'annuncio.');
            }
        });
    }
}

function editAnnuncio(annuncioId) {
    // Redirect the user to the edit page with the announcement ID
    window.location.href = `/annunci/${parseInt(annuncioId)}/modifica`;
}


function confirmDeleteAccount() {
    var confirmation = confirm("Sicuro di voler eliminare l'account?");
    if (confirmation) {
        $.ajax({
            url: '/delete-account',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .done(function(response) {
            alert(response.message); // Mostra un messaggio di successo
            location.reload(); // Aggiorna la pagina dopo l'eliminazione dell'account
        })
        .fail(function(error) {
            console.error('Errore durante l\'eliminazione dell\'account:', error.responseJSON);
            alert('Si è verificato un errore durante l\'eliminazione dell\'account. Controlla la console per ulteriori dettagli.');
        });
    }
}







