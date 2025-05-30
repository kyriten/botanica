<?php

namespace App\Http\Controllers;

use App\Models\Garden;
use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GardenController extends Controller
{
    public function index(Request $request)
    {
        $query = Garden::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $gardens = $query->paginate(10);

        return view('admin.kebun.index', compact('gardens'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255"
        ]);

        $validatedData['user_id'] = auth()->id();

        // Buat slug otomatis dari nama
        $name = strtolower($validatedData['name']);
        if (str_starts_with($name, 'kebun raya')) {
            $slug = 'kr' . trim(str_replace('kebun raya', '', $name));
        } else {
            $slug = str_replace(' ', '', $name);
        }

        $validatedData['slug'] = $slug;

        // Simpan ke database
        try {
            Garden::create($validatedData);

            return redirect()
                ->route('garden.index')
                ->with('success', 'Data ' . $validatedData['name'] . ' berhasil disimpan!');
        } catch (\Exception $e) {
            // Tangani error jika gagal simpan
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data ' . $validatedData['name'] . '. Silakan coba lagi.');
        }
    }

    // Ambil data garden untuk modal edit (AJAX)
    public function edit($slug)
    {
        $garden = Garden::where('slug', $slug)->firstOrFail();
        return response()->json($garden);
    }

    // Update garden
    public function update(Request $request, $slug)
    {
        $garden = Garden::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update slug otomatis jika nama diubah
        $nameLower = strtolower($validatedData['name']);
        if (str_starts_with($nameLower, 'kebun raya')) {
            $newSlug = 'kr' . trim(str_replace('kebun raya', '', $nameLower));
        } else {
            $newSlug = str_replace(' ', '', $nameLower);
        }

        $garden->update([
            'name' => $validatedData['name'],
            'slug' => $newSlug,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate']);
    }

    public function destroy($slug)
    {
        $garden = Garden::where('slug', $slug)->firstOrFail();
        $garden->delete();

        return redirect()->back()->with('success', 'Berhasil! Data kamu telah dihapus.');
    }

    public function deleteGardens(Request $request)
    {
        $ids = $request->input('ids');

        // Hapus semua spot yang terpilih
        Garden::whereIn('id', $ids)->delete();

        return response()->json(['success' => true]);
    }
}
