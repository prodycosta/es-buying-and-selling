function inviaMessaggio() {
    // Ottieni il testo del messaggio
    var message = document.querySelector('textarea[name="message"]').value;

    // Esegui una richiesta AJAX per inviare il messaggio
    $.post('/chat/send', {
        sender_id: 1,  // Sostituisci con l'ID del mittente (potresti ottenerlo dal lato server)
        receiver_id: 2,  // Sostituisci con l'ID del destinatario
        message: message,
        _token: "{{ csrf_token() }}"
    }, function(data) {
        // Aggiorna la chat con il nuovo messaggio
        aggiornaChat();
    });

    // Pulisci il campo del messaggio
    document.querySelector('textarea[name="message"]').value = '';
}

// Funzione per aggiornare la visualizzazione dei messaggi
function aggiornaChat() {
    // Ottieni i messaggi attraverso una richiesta AJAX
    $.get('/chat/1/2', function(data) {
        var messageContainer = document.getElementById('message-container');
        messageContainer.innerHTML = ''; // Pulisci la chat prima di aggiornarla

        // Aggiungi i nuovi messaggi alla chat
        data.messages.forEach(function(message) {
            var messaggio = document.createElement('p');
            messaggio.innerText = message.sender.name + ': ' + message.message;
            messageContainer.appendChild(messaggio);
        });
    });
}

// Aggiorna la chat ogni tot di tempo
setInterval(aggiornaChat, 5000);

// Esegui la funzione per visualizzare i messaggi al caricamento della pagina
aggiornaChat();
