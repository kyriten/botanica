<?php

namespace App\Http\Controllers;

use App\Models\Village;
use App\Models\District;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $villages = Village::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('latitude', 'LIKE', '%' . $search . '%')
                ->orWhere('longitude', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $villages = Village::paginate(10);
        }
        return view("admin.wilayah.kelurahan.index", ["villages" => $villages]);
    }

    public function create()
    {
        $districts = District::all();
        return view("admin.wilayah.kelurahan.create", ["districts" => $districts]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required | max:50",
            "latitude" => "required",
            "longitude" => "required",
        ]);

        Village::create($validatedData);

        return redirect()->route('village.index')->with(['success' => 'Success! Data has been added.']);
    }

    public function destroy($id)
    {
        $village = Village::where('id', $id)->firstOrFail();

        $village->delete();
        return redirect('/village')->with('success', 'Success! Your post has been deleted.');
    }
    public function getCity($districtId)
    {
        $district = District::with('city')->find($districtId);

        if ($district) {
            return response()->json([
                'city' => $district->city->name
            ]);
        }

        return response()->json(['city' => null]);
    }
}
