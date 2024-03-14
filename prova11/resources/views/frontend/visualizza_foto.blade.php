<!-- resources/views/frontend/visualizza_foto.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Foto</title>
</head>
<body>

    <h1>Foto</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome File</th>
                <th>Descrizione</th>
                <th>Data di Creazione</th>
                <th>Immagine</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foto as $fotoItem)
                <tr>
                    <td>{{ $fotoItem->id }}</td>
                    <td>{{ $fotoItem->nome_file }}</td>
                    <td>{{ $fotoItem->descrizione }}</td>
                    <td>{{ $fotoItem->created_at }}</td>
                    <td>
                        @if($fotoItem->nome_file)
                            <img src="{{ asset('storage/' . $fotoItem->nome_file) }}" alt="Immagine">
                        @else
                            N/D
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

