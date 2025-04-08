<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\City;
use App\Models\Post;
use App\Models\Garden;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MapController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $map = Map::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('nama_rempah', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $map = Map::paginate(10);
        }
        $province = Province::all();
        $city = City::all();
        $district = District::all();
        $village = Village::all();
        $post = Post::all();
        $point = Map::all();
        $garden = Garden::all();
        return view("admin.map.index", ["post" => $post, "province" => $province, "city" => $city, "district" => $district, "village" => $village, "map" => $map, "point" => $point, "garden" => $garden]);
    }

    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();
        $districts = District::all();
        $villages = Village::all();
        $post = Post::all();
        $marker = Map::all();
        return view("admin.map.create", ["post" => $post, "provinces" => $provinces, "cities" => $cities, "districts" => $districts, "villages" => $villages, "marker" => $marker]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "image" => "image | file | max:2048",
            "post_id" => "required",
            "garden_id" => "required",
            "province_id" => "required",
            "city_id" => "required",
            "district_id" => "required",
            "village_id" => "required",
            "kingdom" => "required",
            "subkingdom" => "string",
            "superdivision" => "string",
            "division" => "string",
            "class" => "string",
            "subclass" => "string",
            "ordo" => "string",
            "famili" => "string",
            "genus" => "string",
            "species" => "string",
            "latin" => "string",
            "local" => "string",
            "type_of_plant" => "string",
            "garden_name" => "required",
            "province_name" => "required",
            "province_lat" => "required",
            "province_long" => "required",
            "city_name" => "required",
            "city_lat" => "required",
            "city_long" => "required",
            "district_name" => "required",
            "district_lat" => "required",
            "district_long" => "required",
            "village_name" => "required",
            "village_lat" => "required",
            "village_long" => "required",
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('map-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Map::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
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
        return view("admin.map.edit", ["post" => $post, "province" => $province, "city" => $city, "district" => $district, "village" => $village, "map" => $map]);
    }

    public function update(Request $request, $id)
    {
        $map = Map::where('id', $id)->firstOrFail();
        $rules = [
            "post_id" => "required",
            "garden_id" => "required",
            "province_id" => "required",
            "city_id" => "required",
            "district_id" => "required",
            "village_id" => "required",
            "kingdom" => "required",
            "subkingdom" => "string",
            "superdivision" => "string",
            "division" => "string",
            "class" => "string",
            "subclass" => "string",
            "ordo" => "string",
            "famili" => "string",
            "genus" => "string",
            "species" => "string",
            "latin" => "string",
            "local" => "string",
            "type_of_plant" => "string",
            "garden_name" => "required",
            "province_name" => "required",
            "province_lat" => "required",
            "province_long" => "required",
            "city_name" => "required",
            "city_lat" => "required",
            "city_long" => "required",
            "district_name" => "required",
            "district_lat" => "required",
            "district_long" => "required",
            "village_name" => "required",
            "village_lat" => "required",
            "village_long" => "required",
        ];

        $validatedData = $request->validate($rules);

        // Update Image
        if ($request->file('image')) {
            if ($request->file('oldImage')) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('map-images');
        }

        $validatedData['user_id'] = auth()->user()->id;

        $map = Map::updateOrCreate(['id' => $map->id], $validatedData);

        return redirect()->route('map.index')->with(['success' => 'Success! Data has been updated.']);
    }

    public function destroy($id)
    {
        $point = Map::where('id', $id)->firstOrFail();
        if ($point->image) {
            Storage::delete($point->image);
        }
        $point->delete();
        return redirect()->back()->with('success', 'Success! Your post has been deleted.');
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

    // public function getRempahDetails($id)
    // {
    //     $post = Post::find($id);
    //     return response()->json($post);
    // }
}
