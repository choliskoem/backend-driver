<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    use HasFactory;

    protected $table = 't_pemenang';

    protected $fillable = [
        'id_akun',
        'kd_pembelian',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }

    /**
     * Relationship with Pembelian
     */
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'kd_pembelian');
    }
}
