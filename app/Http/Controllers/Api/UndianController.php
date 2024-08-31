<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Undian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class UndianController extends Controller
{
    /**
     * Get the list of undian numbers won by the authenticated user.
     */

    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'id_periode' => 'required|string|exists:t_periode,id_periode',
            'id_akun' => 'required|string|exists:users,id_akun',
            'nominal_belanja' => 'required|numeric|min:0',
        ]);

        try {
            // Create UUID for kd_pembelian
            $kd_pembelian = Uuid::uuid4()->toString();

            // Insert data into t_pembelian table
            DB::table('t_pembelian')->insert([
                'kd_pembelian' => $kd_pembelian,
                'id_periode' => $validatedData['id_periode'],
                'id_akun' => $validatedData['id_akun'],
                'waktu' => now(),
                'nominal_belanja' => $validatedData['nominal_belanja'],
            ]);

            // Calculate points earned
            $points = floor($validatedData['nominal_belanja'] / 50000);

            if ($points > 0) {
                // Insert data into t_point table
                DB::table('t_point')->insert([
                    'kd_karyawan' => Auth::user()->id_akun,
                    'kd_pembelian' => $kd_pembelian,
                    'waktu' => now(),
                    'point' => $points,
                ]);

                // Get the last lottery number from t_undian table
                $lastUndianNumber = DB::table('t_undian')->max('nomor_undian') ?? 0;

                // Insert lottery number for each point earned
                for ($i = 1; $i <= $points; $i++) {
                    DB::table('t_undian')->insert([
                        'kd_undian' => Uuid::uuid4()->toString(),
                        'id_akun' => $validatedData['id_akun'],
                        'nomor_undian' => $lastUndianNumber + $i,
                        'kd_pembelian' => $kd_pembelian,
                        'waktu' => now(),
                    ]);
                }
            }

            // Return success response with data
            return response()->json([
                'success' => true,
                'message' => 'Pembelian berhasil dibuat.',
                'data' => [
                    'points' => $points,
                    'nomor_undian' => $points,
                    'kd_pembelian' => $kd_pembelian,
                ]
            ], 201);
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat pembelian.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

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
