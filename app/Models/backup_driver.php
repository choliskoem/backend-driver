<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class backup_driver extends Model
{
    use HasFactory;
    protected $fillable = [

        'qrcode_id',
        'driver_id',
        'minggu'

    ];
}
