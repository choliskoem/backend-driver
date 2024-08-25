<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undian extends Model
{
    protected $table = 't_undian';

    // Menentukan primary key untuk tabel
    protected $primaryKey = 'kd_undian';

    // Mengatur agar primary key bukan auto-incrementing
    public $incrementing = false;

    // Menentukan tipe data untuk primary key
    protected $keyType = 'string';

    // Menentukan atribut yang dapat diisi
    protected $fillable = [
        'kd_undian',
        'id_akun',
        'nomor_undian',
        'kd_pembelian',
        'waktu',
    ];

    // Menentukan atribut yang harus dikonversi menjadi tipe date
    protected $dates = ['waktu'];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id_akun');
    }

    /**
     * Relasi ke model Pembelian
     */
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'kd_pembelian', 'kd_pembelian');
    }
}
