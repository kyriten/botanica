<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $cities = City::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('latitude', 'LIKE', '%' . $search . '%')
                ->orWhere('longitude', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $cities = City::paginate(10);
        }
        return view("admin.wilayah.kota.index", ["cities" => $cities]);
    }

    public function create()
    {
        $provinces = Province::all();
        return view("admin.wilayah.kota.create", ["provinces" => $provinces]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required | max:50",
            "alt_name" => "required | max:50",
            "latitude" => "required",
            "longitude" => "required",
        ]);

        City::create($validatedData);

        return redirect()->route('city.index')->with(['success' => 'Success! Data has been added.']);
    }

    public function destroy($id)
    {
        $city = City::where('id', $id)->firstOrFail();

        $city->delete();
        return redirect('/city')->with('success', 'Success! Your post has been deleted.');
    }
}
