<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listGames = Games::all();
        return view('games.index', compact('listGames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.add');
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
        return redirect()->route('games.index')->with('success', 'Game created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $game = Games::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'profile_picture' => 'nullable|file|mimes:jpeg,png,gif,svg,jpg',
            'birth_date' => 'required|date',
            'instrument' => 'required',
            'biography' => 'required',
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
            'name' => $validateData['name'],
            'profile_picture' => $profile_picture_path,
            'birth_date' => $validateData['birth_date'],
            'instrument' => $validateData['instrument'],
            'biography' => $validateData['biography'],
        ]);
        return redirect()->route('games.index')->with('success', 'Game created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Games::findOrFail($id);
       
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully');
    }
}
