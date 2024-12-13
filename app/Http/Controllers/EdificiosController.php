<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class EdificiosController extends Controller
{
    public function getEdificios(){
        $edificios= DB::table('edificios')
                        ->join('ficha_edificio', 'ficha_edificio.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
                        ->join('proyectos', 'proyectos.ID_PROYECTO', 'edificios.ID_PROYECTO')
                        ->join('comunidades_autonomas', 'proyectos.ID_AUTONOMIA', 'comunidades_autonomas.ID_COMUNIDAD_AUTONOMA')
                        ->join('provincias', 'proyectos.ID_PROVINCIA', 'provincias.ID_PROVINCIA')
                        ->join('poblaciones', 'proyectos.ID_POBLACION', 'poblaciones.ID_POBLACION')
                        ->get();

        return $edificios;
    }
}
