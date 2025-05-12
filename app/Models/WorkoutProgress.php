<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutProgress extends Model
{
    use HasFactory;

    protected $table = 'workout_progress';

    protected $fillable = [
        'client_id',
        'exercise_id',
        'date',
        'sets_completed',
        'total_repetitions',
        'weight_used',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'sets_completed' => 'integer',
        'total_repetitions' => 'integer',
        'weight_used' => 'float',
    ];

    // Relazione con l'utente (cliente)
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    // Relazione con l'esercizio
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
