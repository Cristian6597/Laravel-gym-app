<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exercise',
        'weight',
        'reps',
        'date',
    ];

    // Relazione con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
