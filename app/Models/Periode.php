<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 't_periode';
    protected $primaryKey = 'id_periode';
    public $incrementing = false;

    protected $fillable = [
        'id_periode',
        'periode',
        'waktu_masuk',
        'waktu_selesai',
        'nominal_bayar'
    ];


    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'id_periode', 'id_periode');
    }
}
