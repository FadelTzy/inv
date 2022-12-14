<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function oBunga()
    {
        return $this->hasMany(Historybunga::class, 'id_realisasi', 'id');
    }
}
