<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcode extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    // protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',

    ];

    // protected $table  = 'qrcodes';
}
