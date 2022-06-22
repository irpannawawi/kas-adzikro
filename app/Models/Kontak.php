<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'kontak';
    
    protected $primaryKey = 'id_kontak';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_kontak',
        'nama_kontak',
        'alamat',
        'no_tlp',
        'email',
    ];

    public $timestamps = false;

}
