<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    protected $table = 'bobot';
    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai',
    ];
}
