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

    protected $fillable = ['kd_karyawan', 'waktu', 'point'];
}
