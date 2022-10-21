<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktp extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oFirst()
    {
        return $this->hasOne(Referal::class, 'id_user', 'id_user')->where('urut',1);
    }
}
