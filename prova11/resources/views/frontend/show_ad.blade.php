<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Annuncio</title>
</head>
<body>

    <h2>Dettagli Annuncio</h2>

    <ul>
        <li><strong>Titolo:</strong> {{ $annuncio->titolo }}</li>
        <li><strong>Immagini:</strong>
            @foreach ($annuncio->immagini as $image)
                <img src="{{ asset($image) }}" alt="Immagine annuncio">
            @endforeach
        </li>
        <li><strong>Tipo Annuncio:</strong> {{ $annuncio->tipo_annuncio }}</li>
        <li><strong>Descrizione:</strong> {{ $annuncio->descrizione }}</li>
        <li><strong>Condizione:</strong> {{ $annuncio->condizione }}</li>
        <li><strong>Prezzo:</strong> {{ $annuncio->prezzo }}</li>
    </ul>

</body>
</html>
