<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unffolow extends Model
{
    use HasFactory;
    protected $table = 't_unfollow';
    protected $primaryKey = 'kd_akun';
    public $incrementing = false;

    protected $fillable = ['kd_akun', 'waktu'];
}
