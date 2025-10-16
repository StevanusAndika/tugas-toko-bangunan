<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    // Tambahkan ini jika nama tabel tidak plural
    protected $table = 'produk';

    // Tambahkan fillable
    protected $fillable = [
        'Produk',
        'Harga',
        'Stok'
    ];

    // Optional: jika ingin menggunakan timestamps
    public $timestamps = true;

    // Relasi
    public function detailPenjualan(): HasMany
    {
        return $this->hasMany(DetailPenjualan::class, 'produk_id');
    }
}
