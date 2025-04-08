<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Register',
            'active' => 'access'
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:1|max:12',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:3|max:16',
        ]);

        User::create($validatedData);
        session()->flash('success', 'Registration successfull! Please login.');
        return redirect('/welcome/admin');
    }
}
