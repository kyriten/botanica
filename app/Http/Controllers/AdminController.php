<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Post;
use App\Models\User;
use App\Models\Garden;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total All Data
        $mapCount = Map::count();

        // Total Data by Garden == 1
        $bogorCount = Map::where('garden_id', 1)->count();
        $garden = Garden::where('id', 1)->first();
        $gardenFirstName = $garden->name;

        // Total Data by Garden == 2
        $cibodasCount = Map::where('garden_id', 2)->count();
        $garden = Garden::where('id', 2)->first();
        $gardenSecondName = $garden->name;

        // Total Data by Garden == 3
        $purwodadiCount = Map::where('garden_id', 3)->count();
        $garden = Garden::where('id', 3)->first();
        $gardenThirdName = $garden->name;

        // Total Data by Garden == 4
        $bedugulCount = Map::where('garden_id', 4)->count();
        $garden = Garden::where('id', 4)->first();
        $gardenFourthName = $garden->name;

        // Memanggil currentTime dan previousTime
        $currentTime = Carbon::now();
        $previousTime = $currentTime->subDay();

        // Menampilkan Jumlah Data Baru dalam Tabel Post Ditambahkan dalam 24 jam terakhir
        $previousCount = Map::where('created_at', '>', $previousTime)->count();
        $currentCount = Map::count();

        $addedCount = $currentCount - $previousCount;

        if ($addedCount > 0) {
            $message = "Data ditambahkan 24 jam lalu";
        } elseif ($addedCount < 0) {
            $message = "Data dikurangi 24 jam lalu";
        } else {
            $message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 1 Ditambahkan dalam 24 jam terakhir
        $previousCountCatOne = Map::where('garden_id', 1)->where('created_at', '>', $previousTime)->count();
        $currentCountCatOne = Map::where('garden_id', 1)->count();

        $bogorAdded = $currentCountCatOne - $previousCountCatOne;

        if ($bogorAdded > 0) {
            $bogorMessage = "Data ditambahkan 24 jam lalu";
        } elseif ($bogorAdded < 0) {
            $bogorMessage = "Data dikurangi 24 jam lalu";
        } else {
            $bogorMessage = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 2 Ditambahkan dalam 24 jam terakhir
        $previousCountCatTwo = Map::where('garden_id', 2)->where('created_at', '>', $previousTime)->count();
        $currentCountCatTwo = Map::where('garden_id', 2)->count();

        $cibodasAdded = $currentCountCatTwo - $previousCountCatTwo;

        if ($cibodasAdded > 0) {
            $cibodasMessage = "Data ditambahkan 24 jam lalu";
        } elseif ($cibodasAdded < 0) {
            $cibodasMessage = "Data dikurangi 24 jam lalu";
        } else {
            $cibodasMessage = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 3 Ditambahkan dalam 24 jam terakhir
        $previousCountCatThree = Map::where('garden_id', 3)->where('created_at', '>', $previousTime)->count();
        $currentCountCatThree = Map::where('garden_id', 3)->count();

        $purwodadiAdded = $currentCountCatThree - $previousCountCatThree;

        if ($purwodadiAdded > 0) {
            $purwodadiMessage = "Data ditambahkan 24 jam lalu";
        } elseif ($purwodadiAdded < 0) {
            $purwodadiMessage = "Data dikurangi 24 jam lalu";
        } else {
            $purwodadiMessage = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 4 Ditambahkan dalam 24 jam terakhir
        $previousCountCatFour = Map::where('garden_id', 4)->where('created_at', '>', $previousTime)->count();
        $currentCountCatFour = Map::where('garden_id', 4)->count();

        $bedugulAdded = $currentCountCatFour - $previousCountCatFour;

        $bedugulMessage = ($bedugulAdded > 0) ? "Data ditambahkan 24 jam yang lalu" : "Data dikurangi 24 jam yang lalu";
        if ($bedugulAdded > 0) {
            $bedugulMessage = "Data ditambahkan 24 jam lalu";
        } elseif ($bedugulAdded < 0) {
            $bedugulMessage = "Data dikurangi 24 jam lalu";
        } else {
            $bedugulMessage = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        $xAxisCategories = [];
        for ($i = 0; $i <= 12; $i++) {
            $xAxisCategories[] = now()->addHours($i)->format('Y-m-d\TH:i:s.000\Z');
        }

        $users = User::all();
        return view("admin.index", compact(
            "users",
            "mapCount",
            "bogorCount",
            "gardenFirstName",
            
            "cibodasCount",
            "gardenSecondName",
            
            "purwodadiCount",
            "gardenThirdName",
            
            "bedugulCount",
            "gardenFourthName",
            
            "addedCount",
            "message",
            "bogorAdded",
            "bogorMessage",
            "cibodasAdded",
            "cibodasMessage",
            "purwodadiAdded",
            "purwodadiMessage",
            "bedugulAdded",
            "bedugulMessage",
            "xAxisCategories"
        ));
    }

    public function profileShow($username)
    {
        $user = User::where('username', ltrim($username, '@'))->firstOrFail();
        return view('admin.profile.index', compact('user'));
    }
}
