<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuanInvestasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oTipe()
    {
        return $this->hasOne(tipeInvest::class, 'id', 'tipe_investasi');
    }
    public function oRiwayat()
    {
        return $this->hasMany(RiwayatInvest::class, 'id_pengajuan', 'id')->where('status','=', 1);
    }
    public function oPenerima()
    {
        return $this->hasOne(Bank::class, 'id', 'id_penerima');
    }
    public function oRealisasi()
    {
        return $this->hasOne(Realisasi::class, 'id_pengajuan', 'id');
    }
    public function oUser()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
    
}
