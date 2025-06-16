<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';

    protected $fillable = [
        'name',
        'description',
        'muscles_involved',
    ];
    public function workoutPlans()
    {
        return $this->belongsToMany(WorkoutPlan::class, 'workout_plan_exercises')
            ->withPivot('sets', 'repetitions', 'load', 'notes')
            ->withTimestamps();
    }
}
