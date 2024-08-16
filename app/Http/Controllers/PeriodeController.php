<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PeriodeController extends Controller
{
    public function index()
    {
        return view('pages.periode.index');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'id_periode' => 'required|string|max:255',
        //     'periode' => 'required|string|max:255',
        //     'waktu_masuk' => 'required|date',
        //     'waktu_selesai' => 'required|date',
        //     'nominal_bayar' => 'required|numeric',
        // ]);

        $id = Uuid::uuid4()->toString();


        Periode::create([
            'id_periode' => $id,
            'periode' => $request->periode,
            'waktu_masuk' => $request->waktu_masuk,
            'waktu_selesai' => $request->waktu_selesai,
            'nominal_bayar' => $request->nominal_bayar,
        ]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan!');
    }
}
