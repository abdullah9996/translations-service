<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Resources\TranslationResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TranslationController extends Controller
{
    /**
     * Display a listing of the translations (by tag, key, or content).
     */
    public function index(Request $request)
    {
        $query = Translation::query();

        if ($request->has('tag')) {
            $query->where('tag', 'LIKE', '%' . $request->input('tag') . '%');
        }

        if ($request->has('key')) {
            $query->where('key', 'LIKE', '%' . $request->input('key') . '%');
        }

        if ($request->has('content')) {
            $query->where('content', 'LIKE', '%' . $request->input('content') . '%');
        }

        return TranslationResource::collection($query->paginate(10));
    }

    /**
     * Store a new translation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key'     => 'required|string|unique:translations,key',
            'content' => 'required|string',
            'locale'   => 'required|string',
            'tag'    => 'required|string',
        ]);

        $translation = Translation::create($validated);

        return new TranslationResource($translation);
    }

    /**
     * Show a specific translation.
     */
    public function show(Translation $translation)
    {
        return new TranslationResource($translation);
    }

    /**
     * Update an existing translation.
     */
    public function update(Request $request, Translation $translation)
    {
        $validated = $request->validate([
            'key'     => 'sometimes|required|string|unique:translations,key,' . $translation->id,
            'content' => 'sometimes|required|string',
            'locale'   => 'required|string',
            'tag'    => 'required|string',
        ]);

        $translation->update($validated);

        return new TranslationResource($translation);
    }

    /**
     * Delete a translation.
     */
    public function destroy(Translation $translation)
    {
        $translation->delete();

        return response()->json(['message' => 'Translation deleted successfully'], 200);
    }

    public function export(){
        return response()->json(
            Cache::get('translations_export')
        );
    }
}
