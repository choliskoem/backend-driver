<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\biodata;
use App\Models\qrcode;
use App\Models\scandriver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // Add unique rule here
            // 'plat_no' => 'required|string|max:255',
            'foto_fb' => 'required|image|mimes:png,jpg,jpeg:max:1024',
            'foto_ig' => 'required|image|mimes:png,jpg,jpeg:max:1024',
            'password' => 'required|string|min:8',
        ]);


        try {
            $uuid = Uuid::uuid4()->toString();
            $fotoFbFilename = time() . '_fb.' . $request->foto_fb->extension();
            $request->foto_fb->storeAs('public/foto_fb', $fotoFbFilename);

            // Simpan foto_ig
            $fotoIgFilename = time() . '_ig.' . $request->foto_ig->extension();
            $request->foto_ig->storeAs('public/foto_ig', $fotoIgFilename);

            $user =  User::create([
                'id' => $uuid,
                'name' => $request->name,
                'username' => $request->username,
                // 'plat_no' => $request->plat_no,
                'foto_fb' => $fotoFbFilename,
                'foto_ig'  => $fotoIgFilename,
                'status' => 'Belum Aktif',
                'password' => Hash::make($request->password),
                // 'password' => Hash::make($request->password),
                'id_type_fb' => '1',
                'id_type_ig' => '2',
                'id_level' => '2',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Ditambahkan',
                'register' => $user
            ], 201);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                return response()->json([
                    'success' => false,
                    'message' => 'Nomor HP sudah digunakan.',
                ], 409);
            }

            // Handle other database errors if needed

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server.',
            ], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login(Request $request)
    {
        // $logindata = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        $user = \App\Models\User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Nomor Hp Atau password Salah',
            ], 404);
        }



        if ($user->status !== 'Aktif') {
            return response()->json([
                'message' => 'Akun Anda belum aktif.',
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }
    //logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            'message' => 'Logout successfully'
        ]);
    }

    public function scanner(Request $request)
    {
        // Check if it's past Thursday 22:00 WITA
        $currentDateTime = Carbon::now()->setTimezone('Asia/Makassar'); // Assuming WITA timezone
        if ($currentDateTime->dayOfWeek >= Carbon::THURSDAY && $currentDateTime->hour >= 22) {

            return response()->json([
                'success' => false,
                'message' => 'Data cannot be inserted after Thursday 22:00 WITA',
            ], 403); // Forbidden status code
        }



        $qrcode = qrcode::where('id', $request->qrcode_id)->first();

        if ($qrcode) {
            // Memeriksa apakah QR code cocok
            if ($qrcode->id === $request->qrcode_id) {
                // Lanjutkan dengan operasi penciptaan scandriver
                $scan = scandriver::create([
                    'qrcode_id' => $request->qrcode_id,
                    'driver_id' => $request->driver_id,
                ]);

                // Menghapus QR code dari tabel qrcode
                qrcode::where('id', $request->qrcode_id)->delete();

                qrcode::create([
                    'id' => Uuid::uuid4()->toString(),
                ]);

                if ($scan) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Berhasil Ditambahkan',
                        'data' => $scan
                    ], 202);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data Gagal Ditambahkan',
                    ], 409);
                }
            } else {
                // QR code tidak cocok, kembalikan respons yang sesuai
                return response()->json([
                    'success' => false,
                    'message' => 'QR Code tidak cocok',
                ], 409);
            }
        } else {
            // QR code tidak ditemukan dalam tabel qrcode
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak ditemukan',
            ], 404);
        }
    }


    public function drivers(Request $request)
    {
        // $users = DB::table('users as u')
        //     ->leftJoin('t_point as p', 'p.kd_karyawan', '=', 'u.id_akun')
        //     ->select('u.name', DB::raw('SUM(p.point) as point'), 'u.id_akun as id')
        //     ->groupBy('u.name', 'u.id_akun')
        //     ->where('u.id_akun', $request->id)
        //     ->first();


        // $users = DB::table('users as u')
        //     ->leftJoin('t_pembelian as pp', 'pp.id_akun', '=', 'u.id_akun')
        //     ->leftJoin('t_point as p', 'p.kd_pembelian', '=', 'pp.kd_pembelian')
        //     ->select('u.name', DB::raw('SUM(p.point) as point'), 'u.id_akun as id')
        //     ->groupBy('u.name', 'u.id_akun')
        //     ->where('u.id_akun', $request->id)
        //     ->first();


        $users = DB::table('users as u')
            ->leftJoin('t_pembelian as pp', 'pp.id_akun', '=', 'u.id_akun')
            ->leftJoin('t_point as p', 'p.kd_pembelian', '=', 'pp.kd_pembelian')
            ->select('u.name', DB::raw('COALESCE(SUM(p.point), 0) as point'), 'u.id_akun as id')
            ->where('u.id_akun', $request->id)
            ->first();


        if ($users) {
            return response()->json([
                'success' => true,
                'message' => 'Driver Found',
                'data' => $users
            ], 205);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }
    }
    public function refresh(Request $request) {}

    public function hasildriver(Request $request)
    {

        $users = DB::table('users as u')
            ->leftJoin('scandrivers as s', 's.driver_id', '=', 'u.id')
            ->select('u.name', DB::raw('COUNT(s.driver_id) as point'), 'u.id')
            ->where('u.roles', 'Driver')
            ->groupBy('u.name', 'u.id')
            ->orderByDesc('point')
            ->limit(5)
            ->get();


        if ($users) {
            return response()->json([
                'success' => true,
                'message' => 'Hasil Perolehan',
                'data' => $users
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hasil Not Found',
                'data' => null
            ], 404);
        }
    }
}
