<?php

namespace App\Http\Controllers;
use App\Models\Annuncio;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class SellController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Aggiungi il middleware 'auth'
    }

    public function sell(Request $request)
{

    if (!Auth::check()) {
        // Utente non autenticato, reindirizza alla pagina di login
        return redirect()->route('login')->with('error', 'Devi effettuare l\'accesso per pubblicare un annuncio.');
    }


    // Valida e salva i dati dell'annuncio nel database
    Annuncio::create([
        'image' => $request->file('image')->store('images'),
        'title' => $request->input('title'),
        'price' => $request->input('price'),
        'description' => $request->input('description'),
        'condition' => $request->input('condition'),
        'position' => $request->input('position'),
        'user_id' => $request->input('user_id'),

        // ... altri campi ...
    ]);

    // Altre azioni dopo la creazione dell'annuncio

    return redirect('/')->with('success', 'Annuncio pubblicato con successo!');
}

    public function index(){
        return view('frontend.sell');
    }

    public function showPhotos()
{
    $photos = Foto::all(); // Ottieni tutte le foto dal database
    return view('frontend.search', compact('photos'));
}

    protected function validator(array $data)
{
    return Validator::make($data, [
            'title' => 'required|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'adType' => 'required|in:sale,gift',
            'description' => 'required',
            'condition' => 'required|in:new,likeNew,excellent,good,damaged',
            'price' => 'required|numeric|max:99999999.99',
            'position' => 'nullable|string',
            'user_id' => 'required',

    ]);
}
}
