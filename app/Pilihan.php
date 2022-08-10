<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pilihan extends Model
{
    protected $table = 'pilihan';
    protected $fillable = [
        'kriteria_id',
        'nama',
        'nilai',
    ];
}
