<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Annuncio;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function index(){
        return view('frontend.account');
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
    // Recupera l'annuncio dal database utilizzando l'ID
    $annuncio = Annuncio::find($id);

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

    return redirect()->route('annunci.show', ['annuncio' => $annuncio])->with('success', 'Annuncio modificato con successo');
}

public function deleteAccount()
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Utente non autenticato.'], 401);
    }

    try {
        // Effettua il logout
        auth()->logout();

        // Elimina l'account dal database
        $user->delete();

        return response()->json(['message' => 'Account eliminato con successo']);
    } catch (\Exception $e) {
        Log::error('Errore durante l\'eliminazione dell\'account: ' . $e->getMessage());
        return response()->json(['error' => 'Errore durante l\'eliminazione dell\'account. Dettagli: ' . $e->getMessage()], 500);
    }
}

public function showChangePasswordForm()
{
    return view('auth.change-password');
}

public function checkCurrentPassword(Request $request) {
    $currentPassword = $request->input('current_password');

    // Verifica la password attuale
    if (Hash::check($currentPassword, auth()->user()->password)) {
        return response()->json(['message' => 'Password corretta'], 200);
    } else {
        return response()->json(['error' => ' password attuale non corretta'], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
}


