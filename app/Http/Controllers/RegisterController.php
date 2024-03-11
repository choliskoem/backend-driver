<?php

namespace App\Http\Controllers;

use App\Models\biodata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $uuid = Uuid::uuid4()->toString();
        $filename = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/verifikasi', $filename);

        $filename2 = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('public/foto', $filename2);



        User::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'no_hp' => $request->nomor,
            'plat_no' => $request->plat,
            'image' => $filename,
            'foto'  => $filename2,
            'roles' => 'Admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect('/')->with('success', 'Registration successful!');
    }
}
