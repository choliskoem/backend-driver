<?php

namespace App\Http\Controllers;

use App\Models\Pemenang;
use App\Models\Undian;
use Illuminate\Http\Request;

class RouletteController extends Controller
{
    /**
     * Menampilkan halaman roulette.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all lottery numbers that have not been selected as winners
        $nomorUndians = Undian::whereNotIn('id_akun', function ($query) {
            $query->select('id_akun')->from('t_pemenang');
        })->get();

        return view('pages.roulete.index', compact('nomorUndians'));
    }

    /**
     * Memilih pemenang secara acak.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function spin()
    {
        // Mengambil semua nomor undian yang belum keluar
        $nomorUndians = Undian::whereNotIn('kd_undian', function ($query) {
            $query->select('kd_undian')->from('t_pemenang');
        })->get();

        // Memeriksa apakah ada nomor undian yang tersedia
        if ($nomorUndians->isEmpty()) {
            return redirect()->route('roulette.index')->with('error', 'Tidak ada nomor undian yang tersedia.');
        }

        // Memilih nomor undian secara acak
        // Memilih nomor undian secara acak
        $winner = $nomorUndians->random();

        // Menandai nomor undian sebagai sudah keluar
        $winner->status = true;
        $winner->save();

        // Mendapatkan kd_undian dan kd_pembelian dari objek winner
        $idAkun = $winner->id_akun;
        $kdPembelian = $winner->kd_pembelian; // Pastikan 'kd_pembelian' ada di tabel 'Undian'

        // Menyimpan pemenang ke tabel "Pemenang"
        Pemenang::create([
            'id_akun' => $idAkun,
            'kd_pembelian' => $kdPembelian,
        ]);

        // Mengembalikan hasil pemenang
        return redirect()->route('roulette.index')->with('success', 'Pemenang nomor undian adalah: ' . $winner->nomor_undian);
    }
}
