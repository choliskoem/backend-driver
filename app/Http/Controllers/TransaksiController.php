<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $periodes = Pembelian::all();
        // $users = User::all();
        $users = DB::table('t_pembelian')
            ->get();


        return view('pages.transaksi.index', compact('periodes', 'users'));
    }
}
