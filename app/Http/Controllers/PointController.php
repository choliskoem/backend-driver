<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    //
    public function index()
    {
        $users = DB::table('users as u')
            ->leftJoin('t_pembelian as pp', 'pp.id_akun', '=', 'u.id_akun')
            ->leftJoin('t_point as p', 'p.kd_pembelian', '=', 'pp.kd_pembelian')
            ->select('u.name', DB::raw('SUM(p.point) as point'), 'u.id_akun as id', 'u.username')
            ->groupBy('u.name', 'u.id_akun', 'u.username')
            ->where('u.id_level', '2')
            ->get();
        // return view('pages.pembelian.index', compact('periodes', 'users'));
        return view('pages.point.index', compact('users'));
    }
}
