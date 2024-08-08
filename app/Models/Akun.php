<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 't_akun';
    protected $primaryKey = 'kd_akun';
    public $incrementing = false;

    protected $fillable = [
        'kd_akun', 'nama', 'username', 'password', 'id_level',  'id_type_fb', 'id_type_ig', 'foto_fb', 'foto_ig', 'status'
    ];

    public function typeFb()
    {
        return $this->belongsTo(Type::class, 'id_type_fb');
    }

    public function typeIg()
    {
        return $this->belongsTo(Type::class, 'id_type_ig');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }
}
