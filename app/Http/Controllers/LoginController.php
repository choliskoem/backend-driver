<?php

namespace App\Http\Controllers;

use App\Models\scandriver;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function proses_login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'no_hp' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } else {
            return redirect('/')->with('error', 'Login Gagal');
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
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
}
