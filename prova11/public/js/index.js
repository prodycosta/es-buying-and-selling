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




