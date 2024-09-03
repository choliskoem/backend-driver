<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUuids, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $keyType = 'string';
    protected $primaryKey = 'id_akun';
    // public $incrementing = false;


    protected $fillable = [
        'id_akun',
        'name',
        'username',
        'password',
        'id_level',  'id_type_fb', 'id_type_ig', 'foto_fb', 'foto_ig', 'status'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function pemenangs()
    {
        return $this->hasMany(Pemenang::class, 'id_akun');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     // 'id' => 'string',
    //     'no_hp_verified_at' => 'datetime',
    //     'password' => 'hashed',

    // ];
}
