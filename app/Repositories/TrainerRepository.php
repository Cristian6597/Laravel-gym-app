<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Trainer;

class TrainerRepository
{

    public function save(Request $request)
    {
        $trainer = $request->user()->Trainers()->create($request->except('image', 'tags'));

        // assegno i tags al veicolo creando un record nella pivot table tag_Trainer
        $trainer->tags()->attach($request->tags, [
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return $trainer;
    }

    public function update(Request $request, Trainer $trainer)
    {
        $trainer->update($request->except('image', 'tags'));
        $trainer->tags()->sync($request->tags, [
            'updated_at' => now()
        ]);
        return $trainer;
    }

    public function delete(Trainer $trainer)
    {
        $trainer->delete();
        return response()->noContent();
    }
}
