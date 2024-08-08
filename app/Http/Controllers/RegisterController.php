<?php

namespace App\Http\Controllers;

use App\Models\Akun;
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
        // Validasi data yang masuk
        $request->validate([
            // 'kd_akun' => 'required|string|max:255|unique:t_akun,kd_akun',
            'username' => 'required|string|max:255',
            // 'password' => 'required|string|min:8|confirmed',
            // 'id_type_fb' => 'required|exists:t_type,id_type',
            // 'id_type_ig' => 'required|exists:t_type,id_type',
            // 'id_level' => 'required|exists:t_level,id_level',
            // 'foto_fb' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'foto_ig' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'status' => 'required|boolean',
        ]);

        // Generate UUID
        $uuid = Uuid::uuid4()->toString();

        // Simpan foto_fb
        $fotoFbFilename = time() . '_fb.' . $request->foto_fb->extension();
        $request->foto_fb->storeAs('public/foto_fb', $fotoFbFilename);

        // Simpan foto_ig
        $fotoIgFilename = time() . '_ig.' . $request->foto_ig->extension();
        $request->foto_ig->storeAs('public/foto_ig', $fotoIgFilename);

        // Simpan data ke database
        User::create([
            'id_akun' => $uuid,
            'name' => $request->name,
            'username' => $request->nomor,
            'password' => Hash::make($request->password),
            'id_type_fb' => '1',
            'id_type_ig' => '2',
            'id_level' => '2',
            'foto_fb' => $fotoFbFilename,
            'foto_ig' => $fotoIgFilename,
            'status' => 'Belum Aktif',
        ]);

        return redirect('/')->with('success', 'Akun berhasil dibuat!');
    }
}
