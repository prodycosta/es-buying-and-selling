<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $receiver->name }}</title>

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



body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .header-container {

            display: flex;
            justify-content: space-between;
            margin-left: 0%;
            background-color: white;
            color: rgb(67, 0, 130);
            margin-top: 20px;
            border: none;

        }

        .nome {
            margin: 0;

        }

        .oggetto {
            margin: 0 auto;

        }

        #chat-container{
            background-color: white;
            max-width: 600px;
            margin: auto;
            overflow-y: scroll;
            max-height: 400px;
            padding: 10px;
            scrollbar-width: thin;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 160px;
        }

        div::-webkit-scrollbar {
            width: 8px;
        }

        div::-webkit-scrollbar-thumb {
            background-color: rgb(67, 0, 130);
            border-radius: 4px;
        }

        p {
            padding: 8px;
            margin: 5px;
            border-radius: 5px;
            max-width: fit-content;
            margin-left: auto;
            margin-right: 0;
            text-align: right;
            background-color: rgb(67, 0, 130);
            color: white;
        }

        p.received {
            background-color: #f2f2f2;
            margin-left: 0;
            text-align: left;
            color: black;
            max-width: fit-content  ;
        }

        form {
            max-width: 600px;
            margin: auto;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            resize: none;
            border-radius: 15px;
            display: inline-block;

        }



        button {
            background-color: rgb(67, 0, 130, 0.0);
            color: rgb(67, 0, 130);
            padding: 10px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            display: inline-block;
            vertical-align: top; /* Allinea il pulsante in alto */
            transition: background-color 0.3s ease,color 0.3s ease;
        }

        p.date-indicator {
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 14px;
        color: #888; /* Colore a tua scelta */
        margin-top: 15px;
        margin-bottom: 10px;
        background-color: white;
        display: block;
        margin-right: auto;

        }




    </style>


</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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



<div id="chat-container">

<div class="header-container">
@php
$otherUserName = ($receiver->id !== auth()->id()) ? $receiver->name : $messages->first()->messageSender->name;
@endphp
    <h2 class="nome"> {{ $otherUserName }} </h2>
    <h2 class='oggetto'>{{ $annuncio->title }}</h2>
</div>

    @php
        $prevDate = null;
    @endphp

    @foreach($messages as $message)

    @php
            $currentDate = $message->created_at->toDateString();
        @endphp

        @if ($currentDate != $prevDate)
            <p class="date-indicator">{{ $message->created_at->format('M d, Y') }}</p>
        @endif
        <p class="{{ ($message->sender_id === auth()->id()) ? 'sent' : 'received' }}">
            @if ($message->sender_id === auth()->id())
                Me:
            @else
                {{ $message->messageSender->name }}:
            @endif
            {{ wordwrap($message->message, 35, "\n", true) }}
        </p>

        @php
            $prevDate = $currentDate;
        @endphp
    @endforeach
</div>

    <form method="post" action="{{ route('chat.store', ['receiver' => $receiver, 'annuncio' => $annuncio]) }}">
        @csrf
        <textarea name="message" rows="3" required></textarea>
        <input type="hidden" name="article_id" value="{{ $annuncio->id }}">
        <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0M4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5z"/>
        </svg>
        </button>
    </form>


    <script>





    const chatContainer = document.getElementById('chat-container');

    function scrollToBottom() {
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    function onMessageSent() {
        // Dopo aver inviato un messaggio, mantieni il focus in basso senza alcun scatto
        chatContainer.style.scrollBehavior = 'auto';
        scrollToBottom();
        // Riattiva la transizione per il normale comportamento di scorrimento
        setTimeout(() => {
            chatContainer.style.scrollBehavior = 'smooth';
        }, 0);
    }

    window.addEventListener('scroll', () => {
        // Aggiusta il comportamento di scroll durante lo scrolling manuale
        if (chatContainer.scrollTop < chatContainer.scrollHeight - chatContainer.clientHeight - 10) {
            chatContainer.style.scrollBehavior = 'auto';
        } else {
            chatContainer.style.scrollBehavior = 'smooth';
        }
    });

    window.addEventListener('resize', scrollToBottom);

    window.onload = scrollToBottom;
</script>

</body>
</html>

