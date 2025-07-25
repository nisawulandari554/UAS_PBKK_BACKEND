<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        $authors = Authors::all();
        return response()->json([
            'message' => 'Daftar author berhasil diambil.',
            'data' => $authors
        ]);
    }

    public function show($id)
    {
        $author = Authors::find($id);
        if (!$author) {
            return response()->json(['message' => 'Author tidak ditemukan.'], 404);
        }
        return response()->json([
            'message' => 'Author ditemukan.',
            'data' => $author
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        $author = Authors::create([
            'author_id' => Str::ulid()->toBase32(),
            'name' => $validated['name'],
            'nationality' => $validated['nationality'],
            'birthdate' => $validated['birthdate'],
        ]);

        return response()->json([
            'message' => 'Author berhasil ditambahkan.',
            'data' => $author
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $author = Authors::find($id);
        if (!$author) {
            return response()->json(['message' => 'Author tidak ditemukan.'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'nationality' => 'sometimes|required|string',
            'birthdate' => 'sometimes|required|date',
        ]);

        $author->update($validated);

        return response()->json([
            'message' => 'Author berhasil diperbarui.',
            'data' => $author
        ]);
    }

    public function destroy($id)
    {
        $author = Authors::find($id);
        if (!$author) {
            return response()->json(['message' => 'Author tidak ditemukan.'], 404);
        }

        $author->delete();

        return response()->json(['message' => 'Author berhasil dihapus.']);
    }
}
