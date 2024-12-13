<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['ID_PROYECTO', 'NOMBRE_PROYECTO'];

    /**
     * Relación con edificios
     */
    public function edificios()
    {
        return $this->hasMany(Edificio::class, 'ID_PROYECTO')->with('ficha_edificio');
    }
}
