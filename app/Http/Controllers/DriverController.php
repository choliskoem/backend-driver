<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        // $users = \App\Models\User::paginate(10);
        // SELECT u.name, COUNT(s.driver_id) as point FROM users u LEFT JOIN scandrivers s on s.driver_id = u.id GROUP BY u.name
        $users = DB::table('users as u')
            ->leftJoin('scandrivers as s', 's.driver_id', '=', 'u.id')
            ->select('u.name', DB::raw('COUNT(s.driver_id) as point'))
            ->groupBy('u.name')
            ->where('u.roles', 'Driver')
            ->orderByDesc('point')
            ->paginate(10);
        return view('pages.driver.index', compact('users'));
    }
}
