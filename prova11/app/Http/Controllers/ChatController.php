<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Messaggio;
use App\Models\Annuncio;
use App\Models\Article;

class ChatController extends Controller
{


public function index($receiverId, Annuncio $annuncio)
{

    $this->middleware('auth');

     $user = Auth::user();
    $receiver = User::find($receiverId);

    // Verifica se l'utente autenticato è coinvolto nella conversazione
    $hasSentMessages = Messaggio::where('article_id', $annuncio->id)
        ->where('sender_id', $user->id)
        ->exists();

    $hasReceivedMessages = Messaggio::where('article_id', $annuncio->id)
        ->where('receiver_id', $user->id)
        ->exists();

    if (!$hasSentMessages && !$hasReceivedMessages) {
        abort(403, 'Accesso negato');
    }

    // Verifica se l'annuncio esiste
    $annuncio = Annuncio::findOrFail($annuncio->id);

    // Verifica se l'annuncio esiste


    $messages = Messaggio::where(function ($query) use ($user, $receiver, $annuncio) {
        $query->where('article_id', $annuncio->id)
            ->where(function ($q) use ($user, $receiver) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            });
    })->orWhere(function ($query) use ($user, $receiver, $annuncio) {
        $query->where('article_id', $annuncio->id)
            ->where(function ($q) use ($user, $receiver) {
                $q->where('sender_id', $receiver->id)
                    ->orWhere('receiver_id', $receiver->id);
            });
    })->orderBy('created_at', 'asc')->get();

    return view('chat.index', compact('receiver', 'messages', 'annuncio'));
}

    public function store(Request $request, User $receiver, Annuncio $annuncio)
    {
        $user = Auth::user();


        Messaggio::create([
            'sender_id' => $user->id,
            'receiver_id' => $receiver->id,
            'message' => $request->input('message'),
            'article_id' => $request->input('article_id'),

        ]);

        return redirect()->route('messages.index');

    }

    public function elencoUtenti()
{
    // Recupera l'elenco degli utenti escludendo l'utente autenticato
    $users = User::where('id', '!=', Auth::id())->get();

    // Passa l'elenco degli utenti alla vista 'chat.elenco_utenti'
    return view('chat.elenco_utenti', compact('users'));
}

public function showMessaggioForm($receiverId, Annuncio $annuncio)
{
    $user = Auth::user();
    $receiver = User::find($receiverId);

    // Verifica se l'utente autenticato è coinvolto nella conversazione


    // Verifica se l'annuncio esiste
    $annuncio = Annuncio::findOrFail($annuncio->id);

    return view('chat.messaggio', compact('receiver', 'annuncio'));
}

}
