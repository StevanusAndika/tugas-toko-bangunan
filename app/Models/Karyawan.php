<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = ['Nama', 'Gender', 'Sandi'];

    public function penjualan(): HasMany
    {
        return $this->hasMany(Penjualan::class, 'pengguna_id');
    }
}
