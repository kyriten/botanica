<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $plants = collect();
        $hasSearch = false;

        if (!empty($query)) {
            $hasSearch = true;
            $plants = Map::where('local', 'like', "%{$query}%")
                ->orWhere('latin', 'like', "%{$query}%")
                ->get();
        }

        if ($request->ajax()) {
            return view('public.partials.plant-list', [
                'plants' => $plants,
                'hasSearch' => $hasSearch
            ])->render();
        }

        $total = $plants->count();

        return view('public.search-results', [
            'plants' => $plants,
            'query' => $query,
            'hasSearch' => $hasSearch,
            'total' => $total  
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
