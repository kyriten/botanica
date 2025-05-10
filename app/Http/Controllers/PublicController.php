<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $plants = collect();
        $hasSearch = false;

        if ($query !== null) {
            $hasSearch = true;
            $plants = Map::where('local', 'like', "%$query%")
                        ->orWhere('latin', 'like', "%$query%")
                        ->get();
        }

        if ($request->ajax()) {
            return view('public.partials.plant-list', [
                'plants' => $plants,
                'hasSearch' => $hasSearch
            ])->render();
        }

        return view('public.index', [
            'plants' => $plants,
            'query' => $query,
            'hasSearch' => $hasSearch
        ]);
    }


    public function show($id)
    {
        $plant = Map::findOrFail($id);
        return view('public.partials.plant-show', compact('plant'));
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('q');

        $plants = Map::where('local', 'LIKE', "%{$query}%")
            ->orWhere('latin', 'LIKE', "%{$query}%")
            ->limit(5)
            ->get(['id', 'local', 'latin']);

        return response()->json($plants);
    }

}
