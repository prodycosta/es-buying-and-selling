<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Annuncio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index(Request $request)
{
    $searchQuery = $request->input('search_query');
    $position = $request->input('position');


    $query = Annuncio::query();



    $annunci = $query->get();

    return view('frontend.search', compact('annunci', 'searchQuery','position'));
}
}
