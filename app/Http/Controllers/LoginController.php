<?php

namespace App\Http\Controllers;

use App\Models\scandriver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LoginController extends Controller
{
    public function index()
    {
        $qr = DB::table('qrcodes')
            ->select('id')
            ->first();

        $qrCode = QrCode::size(100)->generate($qr->id);
        return view('pages.auth.login', compact('qrCode'));
    }

    public function proses_login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status !== 'Aktif') {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda belum aktif.'
                ]);
            }

            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Username Atau Password Salah'
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    // public function show(Request $request)
    // {

    //     return view('pages.auth.login', compact('qrCode'));
    // }
    // public function refresh(Request $request)
    // {
    //     scandriver::create($request->all());

    //     return redirect()->back()->with('message', 'Data berhasil ditambahkan');


    public function latestData()
    {
        $now = now()->toDateTimeString();

        $hasChanges = DB::table('scandrivers')
            ->where('waktu', DB::raw('NOW()'))
            ->first();
        // $latestData = scandriver::latest()->first();
        // $hasChanges = DB;

        return response()->json(['reload' => $hasChanges]);
        // return view('pages.auth.login', compact('latestData'));
    }

    public function php()
    {

        return view('welcome');
    }

    public function showChangePasswordForm()
    {
        return view('pages.auth.reset');
    }
    public function changePassword(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        // Cek apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['error' => 'Kata sandi saat ini salah.']);
        }

        // Update kata sandi
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // return redirect()->back()->with('success', 'Data berhasil disimpan!');
        return redirect()->route('dashboard')->with('success', 'Kata sandi berhasil diubah.');
    }
}
