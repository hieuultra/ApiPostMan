<?php

namespace App\Http\Controllers\Api;

use App\Models\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listGames = Games::all();
        return response()->json($listGames);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'profile_picture' => 'required|file|mimes:jpeg,png,gif,svg,jpg',
            'birth_date' => 'required|date',
            'instrument' => 'required',
            'biography' => 'required',
        ]);
        if ($request->hasFile('profile_picture')) {
            $profile_picture_path = $request->file('profile_picture')->store('upload/img', 'public');
        } else {
            $profile_picture_path = null;
        }

        $games = Games::create([
            'name' => $validateData['name'],
            'profile_picture' => $profile_picture_path,
            'birth_date' => $validateData['birth_date'],
            'instrument' => $validateData['instrument'],
            'biography' => $validateData['biography'],
        ]);
        return response()->json($games, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Games::findOrFail($id);
        return response()->json($game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'nullable',
            'profile_picture' => 'nullable|file|mimes:jpeg,png,gif,svg,jpg',
            'birth_date' => 'nullable|date',
            'instrument' => 'nullable',
            'biography' => 'nullable',
        ]);
        $game = Games::findOrFail($id);

        if ($request->hasFile('profile_picture')) {
            if ($game->profile_picture) {
                Storage::disk('public')->delete($game->profile_picture);
            }
            $profile_picture_path = $request->file('profile_picture')->store('upload/img', 'public');
        } else {
            $profile_picture_path = $game->profile_picture;
        }

        $game->update([
            'name' => $validateData['name'] ?? $game->name,
            'profile_picture' => $profile_picture_path,
            'birth_date' => $validateData['birth_date'] ?? $game->birth_date,
            'instrument' => $validateData['instrument'] ?? $game->instrument,
            'biography' => $validateData['biography'] ?? $game->biography,
        ]);
        return response()->json($game, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Games::findOrFail($id);

        $game->delete();

        return response()->json([
            'message' => 'Success deleted successfully'
        ]);
    }
}
