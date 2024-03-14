<?php

namespace App\Http\Controllers;

use App\Models\Annuncio;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AnnuncioController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Assicura che l'utente sia autenticato per tutte le azioni del controller
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'adType' => 'required|in:sale,gift',
            'description' => 'required',
            'condition' => 'required|in:new,likeNew,excellent,good,damaged',
            'price' => 'required|numeric',
            'position' => 'nullable|string',
            'user_id' => 'required',
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return redirect('/sell')
                ->withErrors($validator)
                ->withInput();
        }

        $imagesPaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');

                $foto = Foto::create([
                    'nome_file' => $path,
                    'descrizione' => 'Descrizione opzionale',
                ]);

                $imagesPaths[] = $foto->id;
            }
        }

        // Utilizza il metodo create per creare e salvare un nuovo Annuncio
        $user_id = auth()->check() ? auth()->id() : null;
        $annuncio = Annuncio::create([
            'title' => $request->input('title'),
            'images' => json_encode($imagesPaths),
            'adType' => $request->input('adType'),
            'description' => $request->input('description'),
            'condition' => $request->input('condition'),
            'price' => $request->input('price'),
            'position' => $request->input('position'),
            'user_id' => $user_id,
        ]);

        $annuncio->fotos()->attach($imagesPaths);

        return view('frontend.sell');
    }

    public function index()
    {
        $annunci = Annuncio::all(); // Ottieni tutti gli annunci dal database
        return view('frontend.index', compact('annunci'));
    }

    public function showPhoto($id)
    {
        $foto = Foto::find($id);

        if (!$foto) {
            return redirect()->back()->with('error', 'Foto non trovata.');
        }

        // Altre azioni, se necessario

        $annunci = Annuncio::all(); // Recupera tutti gli annunci dal database

        return view('frontend.search', compact('annunci'));
    }

    public function showAnnuncio(Annuncio $annuncio)
    {
        $annuncio->load('user');
        return view('annunci.show', compact('annuncio'));
    }
    public function show($id)
    {
        $annuncio = Annuncio::findOrFail($id);
        $user = auth()->user();

        return view('annunci.show', compact('annuncio', 'user'));
    }



    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
public function destroy($id)
{
    $annuncio = Annuncio::findOrFail($id);

    // Verifica che l'utente autenticato sia il proprietario dell'annuncio
    if (auth()->user()->id != $annuncio->user_id) {
        abort(403, 'Accesso negato');
    }

    // Rimuovi l'annuncio
    $annuncio->delete();

    // Opzionale: puoi anche gestire la rimozione delle immagini dal filesystem se necessario

    return response()->json(['message' => 'Annuncio eliminato con successo']);
}


public function edit($id)
{
    // Verifica se l'utente è autenticato
    if (!auth()->check()) {
        abort(403, 'Accesso negato');
    }

    // Recupera l'annuncio dal database utilizzando l'ID
    $annuncio = Annuncio::find($id);

    // Verifica se l'annuncio esiste
    if (!$annuncio) {
        abort(404);
    }

    // Verifica se l'utente autenticato è il proprietario dell'annuncio
    if (auth()->user()->id != $annuncio->user_id) {
        abort(403, 'Accesso negato');
    }

    // Passa l'annuncio alla vista di modifica
    return view('annunci.edit', compact('annuncio'));
}

public function update(Request $request, Annuncio $annuncio) {
    // Verifica se l'utente autenticato è il proprietario dell'annuncio
    if (auth()->user()->id != $annuncio->user_id) {
        abort(403, 'Accesso negato');
    }

    // Validazione dei dati
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
    ]);

    // Aggiorna l'annuncio
    $annuncio->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
    ]);

    return redirect()->route('account.index', ['annuncio' => $annuncio])->with('success', 'Annuncio modificato con successo');
}

public function showMessaggioForm($receiverId, Annuncio $annuncio)
{
    $user = Auth::user();
    $receiver = User::find($receiverId);

    // Verifica se l'utente autenticato è coinvolto nella conversazione
    if (!$receiver || $user->id != $receiver->id) {
        abort(403, 'Accesso negato');
    }

    // Verifica se l'annuncio esiste
    $annuncio = Annuncio::findOrFail($annuncio->id);

    return view('chat.messaggio', compact('receiver', 'annuncio'));
}
}




