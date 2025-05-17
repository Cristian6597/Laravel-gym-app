<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutPlanHasExercise extends Model
{
    use HasFactory;

    protected $table = 'workout_plan_exercises';

    protected $fillable = [
        'workout_plan_id',
        'exercise_id',
        'sets',
        'repetitions',
        'load',
        'notes',
    ];

    // Relazione con il piano di allenamento
    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }

    // Relazione con l'esercizio
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
