<?php

namespace App\Http\Controllers;
use App\Models\Annuncio;
use Illuminate\Http\Request;

class AdController extends Controller
{
     public function store(Request $request)
    {
        $ad = new Annuncio;
        $ad->title = $request->input('adTitle');
        // Aggiungi altri campi del modello e salva nel database
        $ad->save();

        return response()->json(['message' => 'Annuncio salvato con successo'], 200);
    }
}
