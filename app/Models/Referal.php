<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function akunKedua()
    {
        return $this->hasMany(Referal::class, 'id_penerima','id_user')->where('urut',1);
    }
    public function akunKetiga()
    {
        return $this->hasMany(Referal::class, 'id_penerima','id_user')->where('urut',1);
    }
    public function oKtp()
    {
        return $this->hasOne(ktp::class, 'id_user', 'id_user');
    }
}
