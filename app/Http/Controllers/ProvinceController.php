<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->search;

            $provinces = Province::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('latitude', 'LIKE', '%' . $search . '%')
                ->orWhere('longitude', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        } else {
            $provinces = Province::paginate(10);
        }
        return view("admin.wilayah.provinsi.index", ["provinces" => $provinces]);
    }

    public function create()
    {
        return view("admin.wilayah.provinsi.create");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required | max:50",
            "alt_name" => "required | max:50",
            "latitude" => "required",
            "longitude" => "required",
        ]);

        Province::create($validatedData);

        return redirect()->route('province.index')->with(['success' => 'Success! Data has been added.']);
    }

    public function destroy($id)
    {
        $province = Province::where('id', $id)->firstOrFail();

        $province->delete();
        return redirect('/province')->with('success', 'Success! Your post has been deleted.');
    }
}
