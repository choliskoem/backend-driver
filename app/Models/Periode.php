<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 't_periode';
    protected $primaryKey = 'id_periode';

    protected $fillable = [
        'periode', 'waktu_masuk', 'waktu_selesai', 'nominal_bayar'
    ];
}
