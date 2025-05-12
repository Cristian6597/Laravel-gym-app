<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;

    protected $table = 'client_profiles';

    protected $fillable = [
        'user_id',
        'trainer_id',
        'birth_date',
        'gender',
        'height_cm',
        'weight_kg',
        'fitness_goals',
        'training_preferences',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'height_cm' => 'integer',
        'weight_kg' => 'float',
    ];

    // Relazione con l'utente (cliente)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relazione con il trainer
    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }
}
