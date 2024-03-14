<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoId extends Model
{
    use HasFactory;

    protected $table = 'fotoid';

    protected $fillable = [
        'nome',
        'descrizione',
    ];
}
