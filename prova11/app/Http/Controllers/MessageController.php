<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Messaggio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Annuncio;
use Illuminate\Support\Facades\File;
use App\Models\FotoId;
use stdClass;


class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Aggiungi il middleware 'auth'
    }

    public function index()
    {
        $user = Auth::user();

        $chats = DB::table('messages')
            ->select('receiver_id', 'article_id', DB::raw('MAX(created_at) as last_message_time'))
            ->where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->groupBy('receiver_id', 'article_id')
            ->get();

        // Ottieni i dettagli degli utenti e degli annunci per ogni chat
        foreach ($chats as $chat) {
            $chat->receiver = User::find($chat->receiver_id);
            $chat->article = Annuncio::find($chat->article_id);
            $chat->lastMessage = Messaggio::where('receiver_id', $chat->receiver_id)
                                          ->where('article_id', $chat->article_id)
                                          ->orderBy('created_at', 'desc')
                                          ->first();
        }

        $chats = $chats->sortByDesc('lastMessage.created_at');

        return view('frontend.messages', compact('chats'));
    }

    public function showAnnuncio($id)
{
    $annuncio = Annuncio::find($id);

    if (!$annuncio) {
        // Puoi gestire il caso in cui l'annuncio non sia trovato (ad esempio, reindirizzare a una pagina di errore)
        abort(404);
    }

    return view('frontend.messages', compact('annuncio'));
}

public function showPhotos()
{
    $imagesDirectory = public_path('images');
    $photos = File::allFiles($imagesDirectory); // Recupera tutte le foto dalla tabella 'foto_id'
    return view('frontend.messages', compact('annunci' , 'photos'));
}


}
