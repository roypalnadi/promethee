<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $fillable = [
        'nama',
    ];

    public function pilihan()
    {
        return $this->hasMany(Pilihan::class, 'kriteria_id', 'id');
    }
}
