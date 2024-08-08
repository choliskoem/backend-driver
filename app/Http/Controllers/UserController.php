<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = \App\Models\User::paginate(10);
        $users = DB::table('users')
            ->where('id_level', 2)
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id_akun', 'desc')
            ->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }

    public function update(Request $request, $id)
    {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data pengguna (misalnya, name dan email)
        $user->status = 'Aktif';  // Ganti dengan nama baru yang diinginkan
        // $user->email = 'emailbaru@example.com';  // Ganti dengan email baru yang diinginkan

        // Simpan perubahan
        $user->save();

        // Redirect atau respon sesuai kebutuhan
        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }
}
