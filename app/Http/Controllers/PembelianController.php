<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Periode;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $periodes = Periode::all();
        // $users = User::all();
        $users = DB::table('users')
            ->where('id_level', '2')
            ->get();


        return view('pages.pembelian.index', compact('periodes', 'users'));
    }


    public function store(Request $request)
    {
        // Validasi data request
        // $validatedData = $request->validate([
        //     'id_periode' => 'required|string|exists:t_periode,id_periode',
        //     'id_akun' => 'required|string|exists:users,id_akun',
        //     'nominal_belanja' => 'required|numeric|min:0',
        // ]);

        // Membuat UUID untuk kd_pembelian
        $kd_pembelian = Uuid::uuid4()->toString();

        // Insert data pembelian
        DB::table('t_pembelian')->insert([
            'kd_pembelian' => $kd_pembelian,
            'id_periode' => $request->id_periode,
            'id_akun' => $request->id_akun,
            'waktu' => now(),
            'nominal_belanja' => $request->nominal_belanja,
        ]);

        // Menghitung poin yang didapatkan
        $points = floor($request->nominal_belanja / 50000);

        if ($points > 0) {
            // Insert data poin
            DB::table('t_point')->insert([
                'kd_karyawan' => Auth::user()->id_akun,
                'kd_pembelian' => $kd_pembelian,
                'waktu' => now(),
                'point' => $points,
            ]);

            // Menentukan nomor undian terakhir yang ada di tabel undian
            $lastUndianNumber = DB::table('t_undian')->max('nomor_undian') ?? 0;

            // Insert nomor undian untuk setiap poin yang didapatkan
            for ($i = 1; $i <= $points; $i++) {
                DB::table('t_undian')->insert([
                    'kd_undian' => Uuid::uuid4()->toString(),
                    'id_akun' => $request->id_akun,
                    'nomor_undian' => $lastUndianNumber + $i,
                    'kd_pembelian' => $kd_pembelian,
                    'waktu' => now(),
                ]);
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dibuat. Anda mendapatkan ' . $points . ' poin dan ' . $points . ' nomor undian.');
    }
}
