<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Messaggio extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = ['sender_id', 'receiver_id', 'message', 'article_id'];

    public function messageSender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function messageReceiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
    public function annuncio()
    {
        return $this->belongsTo(Annuncio::class, 'annuncio_id');
    }

    public function tabellaUnificata()
    {
        return $this->hasOne(TabellaUnificata::class, 'annuncio_id', 'id');
    }
}
