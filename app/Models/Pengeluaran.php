<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Produk;
class Pengeluaran extends Model {
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;
    protected $fillable = ['id_produk', 'id_user', 'id_kontak', 'id_prson', 'keterangan', 'tanggal', 'nominal', 'tipe'];
    public function produk(){
        return $this->hasOne(Produk::class, 'id_produk','id_produk');
    }

    public function kontak(){
        return $this->hasOne(Kontak::class, 'id_kontak', 'id_kontak');
    }    
    public function prson(){
        return $this->hasOne(Prson::class, 'id_prson', 'id_prson');
    }
    public function user(){
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }
}
