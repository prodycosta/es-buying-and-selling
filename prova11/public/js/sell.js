// script.js
function openOverlay() {
    var overlay = document.querySelector('.overlay');
    overlay.style.display = 'flex';
}

function closeOverlay() {
    var overlay = document.querySelector('.overlay');
    overlay.style.display = 'none';
}


function openSecondDropdown() {
    const errorMessages = document.getElementById('errorMessages');

    // Aggiungi la validazione del prezzo prima di aprire il secondo dropdown
    if (!validatePrice()) {
        // Mostra i messaggi di errore
        errorMessages.style.display = 'block';
        return;  // Esce dalla funzione se la validazione del prezzo fallisce
    }

    // Altre operazioni per aprire il secondo dropdown
    // ...

    // Nascondi i messaggi di errore
    errorMessages.style.display = 'none';
    document.getElementById('secondDropdown').style.display = 'block';
}

function closeSecondDropdown() {
    document.querySelector('.second-dropdown').style.display = 'none';
}

function publishAd() {
    var adTitle = document.getElementById('adTitle').value;
    var adImages = document.getElementById('images').files;
    var adType = document.getElementById('adType').value;
    var adDescription = document.getElementById('description').value;
    var adCondition = document.getElementById('condition').value;
    var adPrice = document.getElementById('price').value;

    console.log('Titolo dell\'annuncio:', adTitle);
    console.log('Immagini:');
    for (var i = 0; i < adImages.length; i++) {
        console.log('Immagine ' + (i + 1) + ':', adImages[i].name);
    }
    console.log('Tipo di annuncio:', adType);
    console.log('Descrizione:', adDescription);
    console.log('Condizione dell\'oggetto:', adCondition);
    console.log('Prezzo:', adPrice);





    closeSecondDropdown();
}




function submitForm() {
    document.getElementById('searchForm').submit();
}


  function ottieniSuggerimenti(testoInput) {
    return dati
      .filter(localita => localita.nome.toLowerCase().includes(testoInput.toLowerCase()))
      .map(localita => localita.nome);
  }

  function mostraSuggerimenti() {
    const position = document.getElementById('position');
    const suggerimentiList = document.getElementById('suggerimenti');
    const erroreNumeri = document.getElementById('erroreNumeri'); // Aggiunto questo

    suggerimentiList.innerHTML = "";
    erroreNumeri.innerHTML = ""; // Pulisci il messaggio di errore

    const testoInput = position.value;

    // Verifica se ci sono numeri nella posizione
    if (/\d/.test(testoInput)) {
        erroreNumeri.textContent = "La posizione non deve contenere numeri"; // Imposta il messaggio di errore
    } else {
        const suggerimenti = ottieniSuggerimenti(testoInput);

        suggerimenti.forEach(suggerimento => {
            const listItem = document.createElement('li');
            listItem.textContent = suggerimento;
            listItem.onclick = function () {
                position.value = suggerimento;
                suggerimentiList.innerHTML = ""; // Nasconde la lista di suggerimenti
            };
            suggerimentiList.appendChild(listItem);
        });
    }
}

function validatePrice() {
    const priceInput = document.getElementById('price');
    const price = parseFloat(priceInput.value);
    const errorMessages = document.getElementById('errorMessages');

    // Pulisci i messaggi di errore
    errorMessages.innerHTML = '';

    if (isNaN(price) || price > 99999999.99) {
        // Mostra un messaggio di errore
        const errorMessage = document.createElement('p');
        errorMessage.textContent = 'Il prezzo deve essere un numero inferiore a 99999999.99';
        errorMessages.appendChild(errorMessage);

        // Pulisci il campo del prezzo
        priceInput.value = '';
        return false;  // Restituisce false se la validazione fallisce
    }

    return true;  // Restituisce true se la validazione ha successo
}

// Associa questa funzione all'evento di click del pulsante di invio
document.getElementById('continuaButton').addEventListener('click', openSecondDropdown);








