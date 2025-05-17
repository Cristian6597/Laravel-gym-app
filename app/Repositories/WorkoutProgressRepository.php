<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\WorkoutProgress;

class WorkoutProgressRepository
{

    public function save(Request $request)
    {
        $workoutProgress = $request->user()->WorkoutProgress()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_WorkoutProgress
        $workoutProgress->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $workoutProgress;
    }

    public function update(Request $request, WorkoutProgress $workoutProgress)
    {
        $workoutProgress->update($request->except('image', 'tags'));
        $workoutProgress->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $workoutProgress;
    }

    public function delete(WorkoutProgress $workoutProgress)
    {
        $workoutProgress->delete();
        return response()->noContent();
    }
}
