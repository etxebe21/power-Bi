<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ViviendasController extends Controller
{
    public function getViviendas(){
        $viviendas =  DB::table('viviendas')
                    ->join('edificios', 'viviendas.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
                    ->join('ficha_edificio', 'edificios.ID_EDIFICIO', 'ficha_edificio.ID_EDIFICIO')
                    ->join('proyectos', 'edificios.ID_PROYECTO', 'proyectos.ID_PROYECTO')
                    ->get();
                    return $viviendas;
    }
}
