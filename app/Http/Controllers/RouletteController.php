<?php

namespace App\Http\Controllers;

use App\Models\Pemenang;
use App\Models\Periode;
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
        // Dapatkan bulan dan tahun saat ini
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Cari periode yang aktif pada bulan dan tahun ini
        $periode = Periode::whereYear('waktu_masuk', $currentYear)
            ->whereMonth('waktu_masuk', $currentMonth)
            ->orWhere(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('waktu_selesai', $currentYear)
                    ->whereMonth('waktu_selesai', $currentMonth);
            })
            ->first();

        $isPeriodeSelesai = $periode && now()->greaterThanOrEqualTo($periode->waktu_selesai);

        // Jika periode ditemukan
        if ($periode) {
            $id_periode = $periode->id_periode;

            // Ambil nomor undian yang belum terpilih sebagai pemenang pada periode yang aktif
            $nomorUndians = Undian::whereNotIn('t_undian.id_akun', function ($query) {
                $query->select('t_pemenang.id_akun')->from('t_pemenang');
            })
                ->join('t_pembelian', 't_undian.kd_pembelian', '=', 't_pembelian.kd_pembelian')
                ->where('t_pembelian.id_periode', $id_periode)  // Filter berdasarkan periode aktif
                ->select('t_undian.*')  // Pilih data dari tabel undian
                ->get();

            return view('pages.roulete.index', compact('nomorUndians', 'isPeriodeSelesai'));
        }

        // Jika tidak ada periode aktif, kirimkan pesan atau view kosong
        return view('pages.roulete.index')->with('message', 'Tidak ada periode aktif untuk bulan ini.');
    }

    /**
     * Memilih pemenang secara acak.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function spin(Request $request)
    {
        // Dapatkan bulan dan tahun saat ini
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Cari periode yang aktif pada bulan dan tahun ini
        $periode = Periode::whereYear('waktu_masuk', $currentYear)
            ->whereMonth('waktu_masuk', $currentMonth)
            ->orWhere(function ($query) use ($currentYear, $currentMonth) {
                $query->whereYear('waktu_selesai', $currentYear)
                    ->whereMonth('waktu_selesai', $currentMonth);
            })
            ->first();

        // Jika tidak ada periode aktif, kirim pesan
        if (!$periode) {
            return redirect()->route('roulette.index')->with('error', 'Tidak ada periode aktif untuk bulan ini.');
        }

        $id_periode = $periode->id_periode;

        // Mengambil semua nomor undian yang belum keluar dari periode aktif
        $nomorUndians = Undian::whereNotIn('kd_undian', function ($query) {
            $query->select('kd_undian')->from('t_pemenang');
        })
            ->join('t_pembelian', 't_undian.kd_pembelian', '=', 't_pembelian.kd_pembelian')
            ->where('t_pembelian.id_periode', $id_periode)
            ->select('t_undian.*')  // Pilih data dari tabel undian
            ->get();

        // Memeriksa apakah ada nomor undian yang tersedia
        if ($nomorUndians->isEmpty()) {
            return redirect()->route('roulette.index')->with('error', 'Tidak ada nomor undian yang tersedia untuk periode ini.');
        }

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
        return redirect()->route('roulette.index')->with('success', 'Pemenang nomor undian dari periode ini adalah: ' . $winner->nomor_undian);
    }
}
