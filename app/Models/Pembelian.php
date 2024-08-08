<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{

    use HasFactory;

    protected $table = 't_pembelian';
    protected $primaryKey = 'kd_pembelian';
    public $incrementing = false;

    protected $fillable = [
        'kd_pembelian', 'id_periode', 'kd_akun', 'waktu', 'nominal_belanja'
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'kd_akun');
    }
}
