<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\City;
use App\Models\Post;
use App\Models\Garden;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use App\Exports\MapsExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\SpotTanamanImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class MapController extends Controller
{
    public function index(Request $request)
    {
        $map = Map::query();

        if ($request->filled('garden_id')) {
            $map->where('garden_id', $request->garden_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $map->where(function ($q) use ($search) {
                $q->where('local', 'LIKE', '%' . $search . '%')
                    ->orWhere('latin', 'LIKE', '%' . $search . '%');
            });
        }

        $map = $map->paginate(10);

        if ($request->ajax()) {
            return view('admin.peta.partials.table', compact('map'))->render();
        }

        // Ini untuk tampilan awal non-AJAX
        $province = Province::all();
        $city = City::all();
        $district = District::all();
        $village = Village::all();
        $post = Post::all();
        $point = Map::all();
        $garden = Garden::all()->map(function ($item) {
            $item->polygon = json_decode($item->polygon, true);
            return $item;
        });

        $gardenData = Garden::all();

        return view("admin.peta.index", compact(
            'post',
            'province',
            'city',
            'district',
            'village',
            'map',
            'point',
            'garden',
            'gardenData'
        ));
    }

    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $post = Post::all();
        $marker = Map::all();
        return view("admin.peta.create", ["post" => $post, "provinces" => $provinces, "cities" => $cities, "districts" => $districts, "villages" => $villages, "marker" => $marker]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'garden_id'       => 'required|exists:gardens,id',
            'province_id'     => 'nullable|integer|exists:provinces,id',
            'city_id'         => 'nullable|integer|exists:cities,id',
            'garden_name'     => 'nullable|string|max:255',
            'province_name'   => 'nullable|string|max:255',
            'city_name'       => 'nullable|string|max:255',
            'plant_lat'       => 'required|numeric',
            'plant_long'      => 'required|numeric',
            'category'        => 'nullable|string|max:255',
            'local'           => 'nullable|string|max:255',
            'latin'           => 'nullable|string|max:255',
            'slug'            => 'nullable|string|max:255|unique:maps,slug',
            'kingdom'         => 'nullable|string|max:255',
            'sub_kingdom'     => 'nullable|string|max:255',
            'super_division'  => 'nullable|string|max:255',
            'division'        => 'nullable|string|max:255',
            'class'           => 'nullable|string|max:255',
            'sub_class'       => 'nullable|string|max:255',
            'ordo'            => 'nullable|string|max:255',
            'famili'          => 'nullable|string|max:255',
            'genus'           => 'nullable|string|max:255',
            'species'         => 'nullable|string|max:255',
            'description'     => 'nullable',
            'plant_image'     => 'nullable|image|file|max:2048',
            'stem_image'      => 'nullable|image|file|max:2048',
            'leaf_image'      => 'nullable|image|file|max:2048',
            'flower_image'    => 'nullable|image|file|max:2048',
            'fruit_image'     => 'nullable|image|file|max:2048',
            'another_image'   => 'nullable|image|file|max:2048',
        ]);

        $garden = Garden::find($validatedData['garden_id']);
        if ($garden) {
            $validatedData['garden_name'] = $garden->name;
        }

        // Cari nama kota dan provinsi berdasarkan city_id
        $city = City::with('province')->find($validatedData['city_id']);

        if ($city) {
            $validatedData['city_name'] = $city->name;
            $validatedData['province_name'] = $city->province->name ?? null;
            $validatedData['province_id'] = $city->province->id ?? null;
        }

        // Upload gambar jika ada
        if ($request->hasFile('plant_image')) {
            $validatedData['plant_image'] = $request->file('plant_image')->store('plant-images', 'public');
        }
        if ($request->hasFile('stem_image')) {
            $validatedData['stem_image'] = $request->file('stem_image')->store('stem-images', 'public');
        }
        if ($request->hasFile('leaf_image')) {
            $validatedData['leaf_image'] = $request->file('leaf_image')->store('leaf-images', 'public');
        }
        if ($request->hasFile('flower_image')) {
            $validatedData['flower_image'] = $request->file('flower_image')->store('flower-images', 'public');
        }
        if ($request->hasFile('fruit_image')) {
            $validatedData['fruit_image'] = $request->file('fruit_image')->store('fruit-images', 'public');
        }
        if ($request->hasFile('another_image')) {
            $validatedData['another_image'] = $request->file('another_image')->store('another-images', 'public');
        }

        // Tambahkan user_id
        $validatedData['user_id'] = auth()->id();

        // Simpan ke DB
        $map = Map::create($validatedData);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan.', 'map' => $map]);
        }
    }

    public function show()
    {
        //
    }

    public function edit($id)
    {
        $map = Map::where('id', $id)->firstOrFail();
        $province = Province::all();
        $city = City::all();
        $district = District::all();
        $village = Village::all();
        $post = Post::all();
        return view("admin.peta.edit", ["post" => $post, "province" => $province, "city" => $city, "district" => $district, "village" => $village, "map" => $map]);
    }

    public function update(Request $request, $id)
    {
        // Mencari map berdasarkan ID
        $map = Map::where('id', $id)->firstOrFail();
        try {
            // Mengambil garden_name berdasarkan garden_id
            $garden = Garden::find($request->garden_id);
            if ($garden) {
                $garden_name = $garden->name;
            } else {
                $garden_name = 'Unknown Garden';
            }

            // Cari nama kota dan provinsi berdasarkan city_id
            $city = City::with('province')->find($request['city_id']);

            if ($city) {
                $request['city_name'] = $city->name;
                $request['province_name'] = $city->province->name ?? null;
                $request['province_id'] = $city->province->id ?? null;
            }

            // Aturan validasi input
            $rules = [
                'garden_id'       => 'required|exists:gardens,id',
                'province_id'     => 'nullable|integer|exists:provinces,id',
                'city_id'         => 'nullable|integer|exists:cities,id',
                'garden_name'     => 'nullable|string|max:255',
                'province_name'   => 'nullable|string|max:255',
                'city_name'       => 'nullable|string|max:255',
                'plant_lat'       => 'required|numeric',
                'plant_long'      => 'required|numeric',
                'category'        => 'nullable|string|max:255',
                'local'           => 'nullable|string|max:255',
                'latin'           => 'nullable|string|max:255',
                'slug'            => 'nullable|string|max:255',
                'kingdom'         => 'nullable|string|max:255',
                'sub_kingdom'     => 'nullable|string|max:255',
                'super_division'  => 'nullable|string|max:255',
                'division'        => 'nullable|string|max:255',
                'class'           => 'nullable|string|max:255',
                'sub_class'       => 'nullable|string|max:255',
                'ordo'            => 'nullable|string|max:255',
                'famili'          => 'nullable|string|max:255',
                'genus'           => 'nullable|string|max:255',
                'species'         => 'nullable|string|max:255',
                'description'     => 'nullable|string|max:255',
                'plant_image'     => 'nullable|image|file|max:2048',
                'leaf_image'      => 'nullable|image|file|max:2048',
                'stem_image'      => 'nullable|image|file|max:2048',
                'flower_image'    => 'nullable|image|file|max:2048',
                'fruit_image'     => 'nullable|image|file|max:2048',
                'another_image'   => 'nullable|image|file|max:2048',
            ];

            // Validasi input
            $validatedData = $request->validate($rules);

            // Update gambar jika ada
            if ($request->hasFile('plant_image')) {
                if ($map->plant_image && Storage::exists($map->plant_image)) {
                    Storage::delete($map->plant_image); // Menghapus gambar lama jika ada
                }
                $validatedData['plant_image'] = $request->file('plant_image')->store('plant-images', 'public');
            }

            if ($request->hasFile('stem_image')) {
                if ($map->stem_image && Storage::exists($map->stem_image)) {
                    Storage::delete($map->stem_image); // Menghapus gambar lama jika ada
                }
                $validatedData['stem_image'] = $request->file('stem_image')->store('stem-images', 'public');
            }

            if ($request->hasFile('leaf_image')) {
                if ($map->leaf_image && Storage::exists($map->leaf_image)) {
                    Storage::delete($map->leaf_image); // Menghapus gambar lama jika ada
                }
                $validatedData['leaf_image'] = $request->file('leaf_image')->store('leaf-images', 'public');
            }

            if ($request->hasFile('flower_image')) {
                if ($map->flower_image && Storage::exists($map->flower_image)) {
                    Storage::delete($map->flower_image); // Menghapus gambar lama jika ada
                }
                $validatedData['flower_image'] = $request->file('flower_image')->store('flower-images', 'public');
            }

            if ($request->hasFile('fruit_image')) {
                if ($map->fruit_image && Storage::exists($map->fruit_image)) {
                    Storage::delete($map->fruit_image); // Menghapus gambar lama jika ada
                }
                $validatedData['fruit_image'] = $request->file('fruit_image')->store('fruit-images', 'public');
            }

            if ($request->hasFile('another_image')) {
                if ($map->another_image && Storage::exists($map->another_image)) {
                    Storage::delete($map->another_image); // Menghapus gambar lama jika ada
                }
                $validatedData['another_image'] = $request->file('another_image')->store('another-images', 'public');
            }

            // Memastikan slug dibuat jika tidak ada
            if (empty($validatedData['slug'])) {
                $validatedData['slug'] = Str::slug($validatedData['latin'] ?? 'default-slug') . '-' . $map->id;
            }

            // Menambahkan garden_name ke dalam data yang akan diupdate
            $validatedData['garden_name'] = $garden_name;

            // Update data
            $map->update($validatedData);

            // Mengembalikan response JSON jika permintaan adalah AJAX
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.',
                'map' => $map
            ]);
        } catch (\Exception $e) {
            // Tangani error dan log detailnya
            Log::error($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses permintaan.'
            ]);
        }
    }

    public function destroy($id)
    {
        $point = Map::where('id', $id)->firstOrFail();
        if ($point->image) {
            Storage::delete($point->image);
        }
        $point->delete();
        return redirect()->back()->with('success', 'Berhasil! Data kamu telah dihapus.');
    }

    public function getCityDetails($id)
    {
        $city = City::find($id);
        return response()->json($city);
    }

    public function getProvinceDetails($id)
    {
        $province = Province::find($id);
        return response()->json($province);
    }


    public function getByGarden($gardenId)
    {
        $maps = Map::where('garden_id', $gardenId)->get([
            'province_name',
            'city_name',
            'plant_lat',
            'plant_long',
            'category',
            'local',
            'latin',
            'kingdom',
            'sub_kingdom',
            'super_division',
            'division',
            'class',
            'sub_class',
            'ordo',
            'famili',
            'genus',
            'species',
            'description',
            'plant_image',
            'stem_image',
            'leaf_image',
            'flower_image',
            'fruit_image',
            'another_image',
        ]);

        return response()->json(['data' => $maps]);
    }

    public function getGardens()
    {
        $gardens = Garden::all()->map(function ($item) {
            $item->polygon = json_decode($item->polygon, true);
            $item->coordinate = json_decode($item->coordinate, true);
            return $item;
        });

        return response()->json(['status' => 'success', 'data' => $gardens]);
    }

    public function getData($id)
    {
        $spot = Map::find($id);

        if (!$spot) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($spot);
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $import = new SpotTanamanImport();

        try {
            Excel::import($import, $request->file('csv_file'));

            $duplicates = $import->getDuplicates();
            $missingGardens = $import->getMissingGardens();

            if (!empty($duplicates)) {
                return response()->json([
                    'status' => 'partial',
                    'message' => 'Beberapa data spot tidak diimpor karena duplikat.',
                    'missingGardens' => $missingGardens,
                    'duplicates' => $duplicates
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Data spot tanaman berhasil diimpor.'
            ], 200);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $messages = [];
            foreach ($failures as $failure) {
                $messages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Kesalahan validasi: ' . implode(', ', $messages)
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kesalahan saat impor: ' . $e->getMessage()
            ], 500);
        }
    }
    public function export()
    {
        $gardenId = session('selected_garden_id');

        if (!$gardenId) {
            return redirect()->back()->withErrors('Kebun belum dipilih!');
        }

        $maps = Map::where('garden_id', $gardenId)
            ->get([
                'category',
                'local',
                'latin',
                'famili',
                'kingdom',
                'sub_kingdom',
                'super_division',
                'division',
                'class',
                'sub_class',
                'ordo',
                'genus',
                'species',
                'description',
                'plant_image',
                'stem_image',
                'leaf_image',
                'flower_image',
                'fruit_image',
                'another_image',
                'garden_name',
                'plant_lat',
                'plant_long',
            ]);

        $gardenName = session('selected_garden_name');
        $timestamp = now()->format('Ymd');
        $filename = "{$timestamp}_{$gardenName}_data_spot_tanaman.xlsx";

        return Excel::download(new MapsExport($maps, $gardenName), $filename);
    }

    public function setGardenSession(Request $request)
    {
        // Simpan ID dan nama kebun yang dipilih dalam session
        session(['selected_garden_id' => $request->input('garden_id')]);
        session(['selected_garden_name' => $request->input('garden_name')]);

        return response()->json(['message' => 'Kebun telah disimpan di session']);
    }

    public function deleteSpots(Request $request)
    {
        $ids = $request->input('ids');

        // Hapus semua spot yang terpilih
        Map::whereIn('id', $ids)->delete();

        return response()->json(['success' => true]);
    }

    public function refreshTable(Request $request)
    {
        $map = Map::query()->paginate(10); // atau sesuai query utama Anda
        return view('admin.peta.partials.spot-table-body', compact('map'));
    }
}
