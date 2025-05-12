<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlan extends Model
{
    use HasFactory;

    protected $table = 'workout_plans';

    protected $fillable = [
        'client_id',
        'trainer_id',
        'title',
        'general_notes',
    ];

    // Relazione con il cliente (utente)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relazione con il trainer (utente)
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
