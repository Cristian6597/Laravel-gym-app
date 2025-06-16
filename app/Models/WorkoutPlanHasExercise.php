<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlanHasExercise extends Model
{
    protected $table = 'workout_plan_exercises'; // nome tabella esatto

    protected $fillable = [
        'workout_plan_id',
        'name',
        'sets',
        'repetitions',
        'load',
        'notes',
    ];

    public function workoutPlan()
    {
        return $this->belongsTo(WorkoutPlan::class);
    }
}
