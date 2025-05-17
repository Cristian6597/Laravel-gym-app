<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\WorkoutPlan;

class WorkoutPlanRepository
{

    public function save(Request $request)
    {
        $workoutPlan = $request->user()->WorkoutPlans()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_WorkoutPlan
        $workoutPlan->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $workoutPlan;
    }

    public function update(Request $request, WorkoutPlan $workoutPlan)
    {
        $workoutPlan->update($request->except('image', 'tags'));
        $workoutPlan->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $workoutPlan;
    }

    public function delete(WorkoutPlan $workoutPlan)
    {
        $workoutPlan->delete();
        return response()->noContent();
    }
}
