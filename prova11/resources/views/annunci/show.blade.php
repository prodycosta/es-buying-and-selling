<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Dettagli Annuncio</title>
    <style>
        body {
    background-color: rgb(255, 255, 255);
}

* {
    margin: 0;
    padding: 0;

}

body{
    font-family: Arial, sans-serif;
}

nav{
    top: 0;
    position: fixed;
    background-color: rgb(42, 10, 72);
    display: flex;
    justify-content: center;
    height: 100px;
    width: 100%;
    z-index: 1000;
}
ul{
    list-style: none;
    display: flex;
    align-items: flex-end;
    margin-bottom: 20px;
}
li{
    margin: 0 35px;
}

a{
    text-decoration: none;
    color: white;
    font-size: 18px;
}

.fa {
    font-size: 24px;
    margin-right: 15px;
}

nav a{
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


        .container {
            margin-top: 6%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .small-card {
            width: 35rem;
            border-radius: 15px;
        }

        .center-text {
            text-align: center;
        }

        .display-4, .display-5 {
            font-size: 1.3rem;
            font-weight: 350;
        }

        .card-img-top {
            width: 100%;
            height: auto;
            border-radius: 15px 15px 0  0;
        }

        /* Aggiunta dell'ombra */
        .small-card.shadow {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>

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
    <div class="card small-card shadow"> <!-- Aggiunta della classe shadow -->
        <!-- Mostra le immagini -->
        @if($annuncio->images)
            <div class="mb-3">
                @foreach ($annuncio->fotos as $foto)
                    <img src="{{ asset($foto->nome_file) }}" alt="Immagine annuncio" class="card-img-top">
                @endforeach
            </div>
        @endif

        <div class="card-body center-text">
            <h5 class="card-title display-4">{{ $annuncio->title }}</h5>
            <p class="card-text display-5">{{ $annuncio->description }}</p>
            <p class="card-text display-5">Condizione: {{ $annuncio->condition }}</p>
            <p class="card-text display-5">Prezzo: ${{ $annuncio->price }}</p>
            <p class="card-text display-5">Tipo di annuncio: {{ $annuncio->adType }}</p>
            <p class="card-text display-5">Posizione: {{ $annuncio->position }}</p>
        </div>
    </div>
</div>

</body>
</html>