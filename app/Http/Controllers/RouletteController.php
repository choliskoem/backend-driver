<?php

namespace App\Http\Controllers;

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
        // Mendapatkan semua nomor undian yang belum keluar
        $nomorUndians = Undian::where('status', false)->get();

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
        $nomorUndians = Undian::where('status', false)->get();

        if ($nomorUndians->isEmpty()) {
            return redirect()->route('roulette.index')->with('error', 'Tidak ada data undian yang tersedia.');
        }

        // Mendapatkan semua id_akun yang sudah memiliki nomor undian keluar
        $excludedAccounts = Undian::where('status', true)->pluck('id_akun')->unique();

        // Menyaring nomor undian berdasarkan id_akun yang belum memiliki nomor keluar
        $eligibleUndians = $nomorUndians->filter(function ($undian) use ($excludedAccounts) {
            return !$excludedAccounts->contains($undian->id_akun);
        });

        if ($eligibleUndians->isEmpty()) {
            return redirect()->route('roulette.index')->with('error', 'Tidak ada data undian yang memenuhi kriteria.');
        }

        // Memilih nomor undian secara acak dari nomor yang memenuhi kriteria
        $winner = $eligibleUndians->random();

        // Menandai nomor undian sebagai sudah keluar
        $winner->status = true;
        $winner->save();

        // Mengembalikan hasil pemenang
        return redirect()->route('roulette.index')->with('success', 'Pemenang nomor undian adalah: ' . $winner->nomor_undian);
    }
}
