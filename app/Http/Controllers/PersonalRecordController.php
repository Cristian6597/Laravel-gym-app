<?php

// app/Http/Controllers/PersonalRecordController.php

namespace App\Http\Controllers;

use App\Models\PersonalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalRecordController extends Controller
{
    // Lista PR dell'utente autenticato
    public function index()
    {
        $user = Auth::user();
        $prs = PersonalRecord::where('user_id', $user->id)->orderBy('date', 'desc')->get();
        return response()->json($prs);
    }

    // Crea un nuovo PR
    public function store(Request $request)
    {
        $request->validate([
            'exercise' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'reps' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $pr = PersonalRecord::create([
            'user_id' => Auth::id(),
            'exercise' => $request->exercise,
            'weight' => $request->weight,
            'reps' => $request->reps,
            'date' => $request->date,
        ]);

        return response()->json($pr, 201);
    }

    // Aggiorna un PR esistente
    public function update(Request $request, $id)
    {
        $pr = PersonalRecord::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'exercise' => 'required|string|max:255',
            'weight' => 'required|numeric|min:0',
            'reps' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        $pr->update($request->only(['exercise', 'weight', 'reps', 'date']));

        return response()->json($pr);
    }

    // Cancella un PR
    public function destroy($id)
    {
        $pr = PersonalRecord::where('user_id', Auth::id())->findOrFail($id);
        $pr->delete();

        return response()->json(['message' => 'Personal record deleted']);
    }
}
