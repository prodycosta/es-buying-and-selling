<?php

namespace App\Http\Controllers;
use App\Models\Foto;
use App\Models\Annuncio;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function index(Request $request)
{
    $searchQuery = $request->input('search_query');
    $position = $request->input('position');
    $adType = $request->input('adType');
    $condition = $request->input('condition', []);
    $ordinamento = $request->input('ordinamento', 'recente');

    $query = Annuncio::query();

    // Filtri
    if ($searchQuery) {
        $query->where('title', 'like', '%' . $searchQuery . '%');
    }

    if ($position) {
        $query->where('position', 'like', '%' . $position . '%');
    }

    if ($adType) {
        $query->where('adType', $adType);
    }

    if (!empty($condition)) {
        $query->whereIn('condition', $condition);
    }

    // Solo per la visualizzazione, senza effettuare una nuova ricerca
    $tipoAnnuncio = $request->input('adType');
    $condizioni = $request->input('condition', []);

    // Applica attributi senza effettuare una nuova ricerca
    if ($tipoAnnuncio) {
        $query->where('adType', $tipoAnnuncio);
    }

    if (!empty($condizioni)) {
        $query->whereIn('condition', $condizioni);
    }

    // Ordinamento
    switch ($ordinamento) {
        case 'recente':
            $query->latest('created_at');
            break;
        case 'meno_caro':
            $query->orderBy('price');
            break;
        case 'piu_caro':
            $query->orderByDesc('price');
            break;
        default:
            // Se l'ordinamento non è specificato o è vuoto, usa l'ordinamento predefinito (es. dal più recente)
            $query->latest('created_at');
            $ordinamento = 'recente'; // Imposta il valore predefinito per la visualizzazione nella vista
            break;
    }

    $annunci = $query->get();

    return view('frontend.search', compact('annunci', 'searchQuery'));
}


    public function showPhotos()
{
    $annunci = Annuncio::all();
    $imagesDirectory = public_path('images');
    $photos = File::allFiles($imagesDirectory);
    return view('frontend.search', compact('annunci' , 'photos'));
}

public function showAnnuncio($id)
{
    $annuncio = Annuncio::find($id);

    if (!$annuncio) {
        // Puoi gestire il caso in cui l'annuncio non sia trovato (ad esempio, reindirizzare a una pagina di errore)
        abort(404);
    }

    return view('frontend.annuncio', compact('annuncio'));
}
}
