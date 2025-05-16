<?php

namespace App\Http\Controllers;

use App\Models\Garden;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total All Data
        $postCount = Post::count();

        // Total Data by Garden == 1
        $category1Count = Post::where('garden_id', 1)->count();
        $category = Garden::where('id', 1)->first();
        $categoryFirstName = $category->name;

        // Total Data by Garden == 2
        $category2Count = Post::where('garden_id', 2)->count();
        $category = Garden::where('id', 2)->first();
        $categorySecondName = $category->name;

        // Total Data by Garden == 3
        $category3Count = Post::where('garden_id', 3)->count();
        $category = Garden::where('id', 3)->first();
        $categoryThirdName = $category->name;

        // Total Data by Garden == 4
        $category4Count = Post::where('garden_id', 4)->count();
        $category = Garden::where('id', 4)->first();
        $categoryFourthName = $category->name;

        // Memanggil currentTime dan previousTime
        $currentTime = Carbon::now();
        $previousTime = $currentTime->subDay();

        // Menampilkan Jumlah Data Baru dalam Tabel Post Ditambahkan dalam 24 jam terakhir
        $previousCount = Post::where('created_at', '>', $previousTime)->count();
        $currentCount = Post::count();

        $addedCount = $currentCount - $previousCount;

        if ($addedCount > 0) {
            $message = "Data ditambahkan 24 jam lalu";
        } elseif ($addedCount < 0) {
            $message = "Data dikurangi 24 jam lalu";
        } else {
            $message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 1 Ditambahkan dalam 24 jam terakhir
        $previousCountCatOne = Post::where('garden_id', 1)->where('created_at', '>', $previousTime)->count();
        $currentCountCatOne = Post::where('garden_id', 1)->count();

        $category1Added = $currentCountCatOne - $previousCountCatOne;

        if ($category1Added > 0) {
            $category1Message = "Data ditambahkan 24 jam lalu";
        } elseif ($category1Added < 0) {
            $category1Message = "Data dikurangi 24 jam lalu";
        } else {
            $category1Message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 2 Ditambahkan dalam 24 jam terakhir
        $previousCountCatTwo = Post::where('garden_id', 2)->where('created_at', '>', $previousTime)->count();
        $currentCountCatTwo = Post::where('garden_id', 2)->count();

        $category2Added = $currentCountCatTwo - $previousCountCatTwo;

        if ($category2Added > 0) {
            $category2Message = "Data ditambahkan 24 jam lalu";
        } elseif ($category2Added < 0) {
            $category2Message = "Data dikurangi 24 jam lalu";
        } else {
            $category2Message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 3 Ditambahkan dalam 24 jam terakhir
        $previousCountCatThree = Post::where('garden_id', 3)->where('created_at', '>', $previousTime)->count();
        $currentCountCatThree = Post::where('garden_id', 3)->count();

        $category3Added = $currentCountCatThree - $previousCountCatThree;

        if ($category3Added > 0) {
            $category3Message = "Data ditambahkan 24 jam lalu";
        } elseif ($category3Added < 0) {
            $category3Message = "Data dikurangi 24 jam lalu";
        } else {
            $category3Message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        // Menampilkan Jumlah Data Baru pada kategori 4 Ditambahkan dalam 24 jam terakhir
        $previousCountCatFour = Post::where('garden_id', 4)->where('created_at', '>', $previousTime)->count();
        $currentCountCatFour = Post::where('garden_id', 4)->count();

        $category4Added = $currentCountCatFour - $previousCountCatFour;

        $category4Message = ($category4Added > 0) ? "Data ditambahkan 24 jam yang lalu" : "Data dikurangi 24 jam yang lalu";
        if ($category4Added > 0) {
            $category4Message = "Data ditambahkan 24 jam lalu";
        } elseif ($category4Added < 0) {
            $category4Message = "Data dikurangi 24 jam lalu";
        } else {
            $category4Message = "Tidak ada perubahan dalam 24 jam terakhir";
        }

        $xAxisCategories = [];
        for ($i = 0; $i <= 12; $i++) {
            $xAxisCategories[] = now()->addHours($i)->format('Y-m-d\TH:i:s.000\Z');
        }

        $users = User::all();
        return view("admin.index", compact(
            "users",
            "postCount",
            "category1Count",
            "categoryFirstName",
            "category2Count",
            "categorySecondName",
            "category3Count",
            "categoryThirdName",
            "category4Count",
            "categoryFourthName",
            "addedCount",
            "message",
            "category1Added",
            "category1Message",
            "category2Added",
            "category2Message",
            "category3Added",
            "category3Message",
            "category4Added",
            "category4Message",
            "xAxisCategories"
        ));
    }

    public function profileShow($username)
{
    $user = User::where('username', ltrim($username, '@'))->firstOrFail();
    return view('admin.profile.index', compact('user'));
}
}
