<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

class FotoController extends Controller
{
    public function index(){
        return view('frontend.sell');
    }

    public function salva(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileNome = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads'), $fileNome);

        $foto = new Foto;
        $foto->nome_file = $fileNome;

        $foto->save();

        return redirect()->route('foto.crea')
            ->with('successo','Foto caricata con successo.');
    }

    public function visualizzaFoto()
{
    $fotos = Foto::all();
    return view('mostra_fotos', compact('fotos'));
}
}
