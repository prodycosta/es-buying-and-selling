<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabellaUnificata extends Model
{
    use HasFactory;

    protected $table = 'tabella_unificata'; // Assicurati che sia il nome corretto della tua tabella nel database

    protected $fillable = [
        'nome',
        'descrizione',
        // Aggiungi altri attributi se necessario
    ];

}
