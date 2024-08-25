<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Undian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UndianController extends Controller
{
    /**
     * Get the list of undian numbers won by the authenticated user.
     */
    public function getNomorUndianByUser(Request $request)
    {
        // Ambil pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Ambil nomor undian yang dimenangkan oleh pengguna ini
        $nomorUndian = Undian::where('id_akun', $user->id_akun)
            ->select('nomor_undian', 'waktu', 'kd_pembelian')
            ->orderBy('waktu', 'desc')
            ->get();

        // Kembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'List of udian',
            'data' => $nomorUndian
        ], 200);
    }
}
