<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    
    protected $primaryKey = 'id_produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'foto',
        'harga',
        'kredit_akun_id',
    ];

    public $timestamps = false;

    public function transaksi()
    {
       return $this->hasMany(Pemasukan::class, 'id_produk', 'id_produk');
    }

    public function akun()
    {
        return $this->hasOne(Akun::class, 'kode_akun', 'kredit_akun_id');
    }
}
