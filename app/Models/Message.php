<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'content',
        'sent_at',
        'read',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'read' => 'boolean',
    ];

    // Mittente del messaggio
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Destinatario del messaggio
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
