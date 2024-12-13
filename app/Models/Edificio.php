<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edificio extends Model
{
    use HasFactory;

    protected $fillable = ['ID_EDIFICIO', 'ID_PROYECTO'];

    /**
     * Relación con ficha_EDIFICIO
     */
    public function ficha_EDIFICIO()
    {
        return $this->hasOne(FichaEdificio::class, 'ID_EDIFICIO', 'ID_EDIFICIO');
    }
}
