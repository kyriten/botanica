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
        $hasSearch = false;

        $plantsQuery = Map::query();

        if (!empty($query)) {
            $hasSearch = true;

            $plantsQuery->where(function ($q) use ($query) {
                $q->where('local', 'like', "%{$query}%")
                    ->orWhere('latin', 'like', "%{$query}%")
                    ->orWhere('category', 'like', "%{$query}%")
                    ->orWhere('garden_name', 'like', "%{$query}%")
                    ->orWhere('kingdom', 'like', "%{$query}%")
                    ->orWhere('sub_kingdom', 'like', "%{$query}%")
                    ->orWhere('super_division', 'like', "%{$query}%")
                    ->orWhere('division', 'like', "%{$query}%")
                    ->orWhere('class', 'like', "%{$query}%")
                    ->orWhere('sub_class', 'like', "%{$query}%")
                    ->orWhere('ordo', 'like', "%{$query}%")
                    ->orWhere('famili', 'like', "%{$query}%")
                    ->orWhere('genus', 'like', "%{$query}%")
                    ->orWhere('species', 'like', "%{$query}%");
            });
        }

        $plants = $plantsQuery->paginate(10)->appends([
            'search' => $query,
            'tab' => $request->input('tab', 'all'),
        ]);

        if ($request->ajax()) {
            $tab = $request->input('tab', 'all');

            if ($tab === 'all') {
                $html = view('public.partials.plant-list', [
                    'plants' => $plants,
                    'hasSearch' => $hasSearch,
                ])->render();
            } elseif ($tab === 'image') {
                $html = view('public.partials.plant-list-image', [
                    'plants' => $plants,
                    'hasSearch' => $hasSearch,
                ])->render();
            }

            // Bungkus dengan div agar selector di JS tidak error
            return '<div class="search-results-all">' . $html . '</div>';
        }

        if (!$request->has('search')) {
            return redirect('/');
        }

        $total = $plants->total();

        return view('public.search-results', [
            'plants' => $plants,
            'query' => $query,
            'hasSearch' => $hasSearch,
            'total' => $total,
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
