<?php

namespace App\Models;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Events\QueryExecuted;

class scandriver extends Model
{
    use HasFactory;

    protected $keyType = 'string';

    public $incrementing = false;
    protected $fillable = [

        'qrcode_id',
        'driver_id',

    ];

    protected $listen = [
        QueryExecuted::class => [
            AuthController::class,
        ],
    ];
}
