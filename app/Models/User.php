<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function oKtp()
    {
        return $this->hasOne(ktp::class, 'id_user', 'id');
    }
    public function oDatasaldo()
    {
        return $this->hasOne(saldoUser::class, 'id_user', 'id');
    }
    public function mDeposit()
    {
        return $this->hasMany(Deposit::class, 'id_user', 'id')->where('jenis',1);
    }
    public function akunPertama()
    {
        return $this->hasMany(Referal::class, 'id_penerima', 'id')->where('urut',1);
    }
    public function bonusReferal()
    {
        return $this->hasMany(Referal::class,'id_penerima','id');
    }
    public function mWd()
    {
        return $this->hasMany(Withdraw::class, 'id_user', 'id');
    }
    public function oSaldo()
    {
        return $this->hasMany(pengajuanInvestasi::class, 'id_user', 'id')->latest();
    }
    public function oTotalInvest()
    {
        return $this->hasMany(pengajuanInvestasi::class, 'id_user', 'id')->where('status_investasi','!=',0);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
