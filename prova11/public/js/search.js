function apriTendina() {
    document.getElementById('filtriTendina').style.display = 'block';
    document.getElementById('btnFiltri').style.display = 'none';
}

function chiudiTendina() {
    document.getElementById('filtriTendina').style.display = 'none';
    document.getElementById('btnFiltri').style.display = 'block';
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
    const posizioneInput = document.getElementById('posizioneInput');
    const suggerimentiList = document.getElementById('suggerimenti');
    suggerimentiList.innerHTML = "";

    const testoInput = posizioneInput.value;
    const suggerimenti = ottieniSuggerimenti(testoInput);

    suggerimenti.forEach(suggerimento => {
      const listItem = document.createElement('li');
      listItem.textContent = suggerimento;
      listItem.onclick = function() {
        posizioneInput.value = suggerimento;
        suggerimentiList.innerHTML = ""; // Nasconde la lista di suggerimenti
      };
      suggerimentiList.appendChild(listItem);
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    // Al caricamento della pagina, imposta gli stati delle checkbox in base agli URL
    setCheckboxStatesFromURL();

    // Aggiungi un gestore di eventi per le checkbox
    var conditionCheckboxes = document.querySelectorAll('input[name="condition[]"]');
    conditionCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            // Aggiorna l'URL e rifai la ricerca ogni volta che cambia una checkbox
            updateURLWithCheckboxStates();
            submitForm();
        });
    });
});

function setCheckboxStatesFromURL() {
    // Leggi gli URL e imposta gli stati delle checkbox in base ai parametri di ricerca
    var urlParams = new URLSearchParams(window.location.search);
    var conditionCheckboxes = document.querySelectorAll('input[name="condition[]"]');

    conditionCheckboxes.forEach(function (checkbox) {
        var conditionValue = checkbox.value;
        var isChecked = urlParams.getAll('condition[]').includes(conditionValue);
        checkbox.checked = isChecked;
    });
}

function updateURLWithCheckboxStates() {
    // Aggiorna l'URL con gli stati delle checkbox
    var urlParams = new URLSearchParams(window.location.search);
    var conditionCheckboxes = document.querySelectorAll('input[name="condition[]"]');

    conditionCheckboxes.forEach(function (checkbox) {
        var conditionValue = checkbox.value;

        if (checkbox.checked) {
            // Aggiungi la condizione selezionata all'URL
            urlParams.append('condition[]', conditionValue);
        } else {
            // Rimuovi la condizione deselezionata dall'URL
            urlParams.delete('condition[]');
        }
    });

    // Aggiorna l'URL senza ricaricare la pagina
    history.replaceState({}, '', window.location.pathname + '?' + urlParams.toString());
}



