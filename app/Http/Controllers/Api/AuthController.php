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
            'no_hp' => 'required|string|max:255|unique:users', // Add unique rule here
            'plat_no' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'foto' => 'required|image|mimes:png,jpg,jpeg',
            'password' => 'required|string|min:8',
        ]);

        try {
            $uuid = Uuid::uuid4()->toString();
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/verifikasi', $filename);

            $filename2 = time() .  '.' . $request->foto->extension();
            $request->foto->storeAs('public/foto', $filename2);

            $user =  User::create([
                'id' => $uuid,
                'name' => $request->name,
                'no_hp' => $request->no_hp,
                'plat_no' => $request->plat_no,
                'image' => $filename,
                'foto'  => $filename2,
                'roles' => 'Driver',
                'password' => Hash::make($request->password),
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

        $user = \App\Models\User::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return response([
                'message' => 'Number not found',
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {

            return response([
                'message' => 'Password is wrong',
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
        $users = DB::table('users as u')
            ->leftJoin('scandrivers as s', 's.driver_id', '=', 'u.id')
            ->select('u.name', DB::raw('COUNT(s.driver_id) as point'), 'u.id')
            ->groupBy('u.name', 'u.id')
            ->where('u.id', $request->id)
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
    public function refresh(Request $request)
    {
    }

    public function checkqr(Request $request)
    {
    }
}
