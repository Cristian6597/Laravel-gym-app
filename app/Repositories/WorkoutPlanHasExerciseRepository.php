<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\WorkoutPlanHasExercise;

class WorkoutPlanHasExerciseRepository
{

    public function save(Request $request)
    {
        $workoutPlanHasExercise = $request->user()->WorkoutPlanHasExercises()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_WorkoutPlanHasExercise
        $workoutPlanHasExercise->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $workoutPlanHasExercise;
    }

    public function update(Request $request, WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $workoutPlanHasExercise->update($request->except('image', 'tags'));
        $workoutPlanHasExercise->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $workoutPlanHasExercise;
    }

    public function delete(WorkoutPlanHasExercise $workoutPlanHasExercise)
    {
        $workoutPlanHasExercise->delete();
        return response()->noContent();
    }
}
