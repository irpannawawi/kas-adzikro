<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prson extends Model
{
    use HasFactory;
        protected $table = 'prson_level';
    
    protected $primaryKey = 'id_prson';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_level',
    ];

    public $timestamps = false;
}
