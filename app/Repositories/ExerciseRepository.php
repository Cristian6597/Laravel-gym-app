<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Exercise;

class ExerciseRepository
{

    public function save(Request $request)
    {
        $exercise = $request->user()->Exercises()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_Exercise
        $exercise->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $exercise;
    }

    public function update(Request $request, Exercise $exercise)
    {
        $exercise->update($request->except('image', 'tags'));
        $exercise->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $exercise;
    }

    public function delete(Exercise $exercise)
    {
        $exercise->delete();
        return response()->noContent();
    }
}
