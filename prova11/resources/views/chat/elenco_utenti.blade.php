<!-- resources/views/chat/elenco_utenti.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Utenti</title>
</head>
<body>
    <h1>Elenco Utenti</h1>

    @foreach($users as $user)
        <div class="user-card">
            <p>{{ $user->name }}</p>
            <!-- Altri dettagli utente... -->
            <a href="{{ route('chat.index', ['receiver' => $user->id]) }}">Inizia Chat</a>
        </div>
    @endforeach
</body>
</html>
