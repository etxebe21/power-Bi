<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaEdificio extends Model
{
    use HasFactory;

    protected $fillable = ['ID_EDIFICIO', 'ID_PROYECTO', 'NOMBRE'];

    /**
     * Relación con edificio
     */
    public function edificio()
    {
        return $this->belongsTo(Edificio::class, 'ID_EDIFICIO');
    }
}
