<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Garden;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $categories = Map::select('category')->distinct()->whereNotNull('category')->pluck('category')->sort()->toArray();
        $gardens = Garden::all();
        return view('public.index', compact('categories', 'gardens'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');
        $hasSearch = false;

        $plantsQuery = Map::query();

        // Filter berdasarkan teks pencarian
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

        // Filter berdasarkan kategori
        if (!empty($category)) {
            $plantsQuery->where('category', $category);
        }

        // Ambil data kategori unik untuk dropdown filter
        $categories = Map::select('category')->distinct()->whereNotNull('category')->pluck('category')->sort()->toArray();

        $plants = $plantsQuery->paginate(10)->appends([
            'search' => $query,
            'category' => $category,
            'tab' => $request->input('tab', 'all'),
        ]);

        if ($request->ajax()) {
            $tab = $request->input('tab', 'all');

            $html = view($tab === 'image' ? 'public.partials.plant-list-image' : 'public.partials.plant-list', [
                'plants' => $plants,
                'hasSearch' => $hasSearch,
            ])->render();

            return '<div class="search-results-all">' . $html . '</div>';
        }

        if (!$request->has('search') && !$request->has('category')) {
            return redirect('/');
        }

        $total = $plants->total();

        $gardens = Garden::all();

        return view('public.search-results', [
            'plants' => $plants,
            'query' => $query,
            'category' => $category,
            'categories' => $categories,
            'hasSearch' => $hasSearch,
            'total' => $total,
            'gardens' => $gardens
        ]);
    }

    public function show($id)
    {
        // $plant = Map::findOrFail($id);
        $plant = Map::with('garden')->findOrFail($id);
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

    public function showMaps($slug)
    {
        $garden = Garden::where('slug', $slug)->firstOrFail();

        $count = Map::where('garden_id', $garden->id)->count();

        if ($count === 0) {
            // Redirect ke halaman aman (misalnya search) dengan query ?garden=slug&nodata=true
            return redirect()->route('garden.showNoGardenData', [
                'slug' => $slug,
                'nodata' => 'true'
            ]);
        }

        $maps = Map::where('garden_id', $garden->id)->paginate(5);
        $map = Map::where('garden_id', $garden->id)->firstOrFail();

        return view('public.partials.spots-in-garden', compact('maps', 'map', 'count', 'garden'));
    }


    public function showGardens()
    {
        $gardens = Garden::all();
        $count = Garden::all()->count();

        return view('public.garden-results', compact('gardens', 'count'));
    }

    public function showNoGardenData($slug)
    {
        $garden = Garden::where('slug', $slug)->firstOrFail();
        $count = Map::where('garden_id', $garden->id)->count();

        return view('public.partials.no-garden-data', compact('garden', 'count'));
    }
}
