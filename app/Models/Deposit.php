<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oPenerima()
    {
        return $this->hasOne(Bank::class, 'id', 'id_penerima');
    }
    public function oRekening()
    {
        return $this->hasOne(Bankuser::class, 'id', 'id_rekening');
    }
    public function oUser()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
