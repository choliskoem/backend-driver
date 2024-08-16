<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $table = 't_point';
    protected $primaryKey = 'kd_karyawan';
    public $incrementing = false;

    protected $fillable = ['kd_karyawan','kd_pembelian', 'waktu', 'point'];


    public function user()
    {
        return $this->belongsTo(User::class, 'kd_karyawan', 'id_akun');
    }
}
