<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $districts = District::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('latitude', 'LIKE', '%' . $search . '%')
                ->orWhere('longitude', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $districts = District::paginate(10);
        }
        return view("admin.wilayah.kecamatan.index", ["districts" => $districts]);
    }

    public function create()
    {
        $cities = City::all();
        return view("admin.wilayah.kecamatan.create", ["cities" => $cities]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required | max:50",
            "alt_name" => "required | max:50",
            "latitude" => "required",
            "longitude" => "required",
        ]);

        District::create($validatedData);

        return redirect()->route('district.index')->with(['success' => 'Success! Data has been added.']);
    }

    public function destroy($id)
    {
        $district = District::where('id', $id)->firstOrFail();

        $district->delete();
        return redirect('/district')->with('success', 'Success! Your post has been deleted.');
    }

    public function getProvince($cityId)
    {
        $city = City::with('province')->find($cityId);

        if ($city) {
            return response()->json([
                'province' => $city->province->name
            ]);
        }

        return response()->json(['province' => null]);
    }
}
