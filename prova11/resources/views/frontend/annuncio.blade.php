<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background-color: rgb(255, 255, 255);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            top: 0;
            position: fixed;
            background-color: rgb(42, 10, 72);
            display: flex;
            justify-content: center;
            height: 100px;
            width: 100%;
            z-index: 1000;
        }

        ul {
            list-style: none;
            display: flex;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        li {
            margin: 0 35px;
        }

        a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .fa {
            font-size: 24px;
            margin-right: 15px;
        }

        nav a {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
            color: aliceblue;
        }

        nav span {
            font-size: 14px;
            margin-top: 10px;
            color: aliceblue;
        }

        /* Stili per il contenitore centrato */
        .contenitore-centrato {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: left;
        }

        /* Stili per l'immagine grande */
        .immagine-grande {
            margin-right: 20px;
        }

        .immagine-grande img {
            max-width: 100%;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            margin-top: 20%;
        }

        /* Stili per le informazioni sull'annuncio */
        .informazioni {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            flex-grow: 1;
            margin-top: 6%;
        }

        /* Stili per il titolo dell'annuncio */
        .informazioni h2 {
            color: #000;
            font-weight: bold;
        }

        /* Stili per i dettagli dell'annuncio */
        .informazioni p {
            margin: 10px 0;
            color: #555;
        }

        /* Stili per il prezzo */
        .informazioni p.price {
            color: #800080;
        }

        /* Stili per il container del venditore e della chat */
        .venditore-container {
            display: none;
            /* Inizialmente nascosto */
            margin-top: 20px;
        }

        /* Stili per la chat box */
        .chat-box {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
    <script src="{{ asset('js/annuncio.js') }}"></script>
    <title>Dettagli Annuncio</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="{{ route('index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-lightning" viewBox="0 0 16 16">
            <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873-.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641zM6.374 1 4.168 8.5H7.5a.5.5 0 0 1 .478.647L6.78 13.04 11.478 7H8a.5.5 0 0 1-.474-.658L9.306 1z"/>
            </svg>
            </a>
            <span class="d-block">Home</span>
        </li>
        <li><a href="{{route('search.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
            </svg>
            </a>
            <span class="d-block">Cerca</span>
        </li>
        <li><a href="{{route('sell.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
            </svg>
            </a>
            <span class="d-block">Vendi</span>
        </li>
        <li><a href="{{route('messages.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
            </svg>
            </a>
            <span class="d-block">Messaggi</span>
        </li>
        <li><a href="{{ route('account.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            </a>
            <span class="d-block">Account</span>
        </li>
    </ul>
</nav>
<div class="container">
    <!-- Prima sezione: Informazioni sull'annuncio -->
    <div class="contenitore-centrato">
        <div class="immagine-grande">
            @if ($annuncio->fotos->first())
                <img src="{{ asset($annuncio->fotos->first()->nome_file) }}" alt="Immagine annuncio">
            @else
                <p>Immagine non disponibile</p>
            @endif
        </div>
        <div class="informazioni">
            <h2>{{ $annuncio->title }}</h2>
            <p class="position">Posizione: {{ $annuncio->position }}</p>
            <p>{{ $annuncio->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="price"> {{ $annuncio->price }} $</p>
            <p>Condizione: {{ $annuncio->condition }}</p>
            <p>Tipo di Annuncio: {{ $annuncio->adType }}</p>
        </div>
    </div>
    <!-- Seconda sezione: Descrizione sotto l'immagine -->
    <!-- Seconda sezione: Descrizione sotto l'immagine -->
    <div class="contenitore-centrato">
    <div class="immagine-grande"></div>
    <div class="informazioni">
        <p class="description">Descrizione: {{ $annuncio->description }}</p>

        <!-- Contenitore con il titolo, prezzo, textarea e bottone Invia -->
        @auth
        <div class="contenitore-oggetto">
            <h4>{{ $annuncio->title }}</h4>
            <p>Venduto da: {{ $annuncio->user->name }}</p>
            <p>Prezzo: {{ $annuncio->price }} $</p>
        </div>
        @else
        <p>Per inviare un messaggio, effettua l'accesso.</p>
        @endauth
    </div>
</div>
@if(Auth::check()) <!-- Verifica se l'utente è autenticato -->
    <div class="chat-section">
        <form id="chat-form">
            @csrf
            <a href="{{ route('chat.messaggio-form', ['receiver' => $annuncio->user->id, 'annuncio' => $annuncio->id]) }}" class="btn btn-primary" data-identifier="{{ $annuncio->identifier }}">Contatta</a>
        </form>
    </div>
@endif

<script>

        // Ottieni l'elemento con l'ID "chat-form"
var chatForm = document.getElementById('chat-form');

// Ottieni l'attributo "data-identifier" dal link nella form
var chatIdentifier = chatForm.querySelector('a').getAttribute('data-identifier');

// Ora puoi utilizzare chatIdentifier come necessario nella tua logica JavaScript


</script>

</body>
</html>




