<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Pembelian extends Model
{

    use HasFactory;

    protected $table = 't_pembelian';
    protected $primaryKey = 'kd_pembelian';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kd_pembelian',
        'id_periode',
        'id_akun',
        'waktu',
        'nominal_belanja'
    ];

    // Relasi ke periode
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id_periode');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id_akun');
    }

 
}
