<?php

namespace App\Http\Controllers;

use App\Models\backup_driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    //
    public function index(Request $request)
    {


        $users = DB::table('backup_drivers as b')
            ->when($request->input('minggu'), function ($query, $name) {
                return $query->where('minggu', 'like', '%' . $name . '%');
            })
            ->leftJoin('users as u', 'b.driver_id', '=', 'u.id')
            ->select('u.name', DB::raw('count(b.driver_id) as point'), 'b.minggu')
            ->groupBy('u.name', 'b.minggu')
            ->where('u.roles', 'Driver')
            ->orderByDesc('point')

            ->paginate(10);

        return view('pages.backup.index', compact('users'));
    }

    public function create()
    {
        return view('pages.backup.create');
    }

    public function store(Request $request)
    {
        //
        DB::insert("
        INSERT INTO backup_drivers (qrcode_id, driver_id, minggu, created_at, updated_at)
        SELECT qrcode_id, driver_id, '" . $request->minggu . "' as minggu, created_at, updated_at
        FROM scandrivers
    ");

        DB::table('scandrivers')->truncate();

        return redirect()->route('backup.index')->with('success', 'Option Created Successfully');
    }
}
