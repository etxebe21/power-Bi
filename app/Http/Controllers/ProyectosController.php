<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class ProyectosController extends Controller
{
    public function getProyectos(){
        $proyectos = DB::table('proyectos')
            ->join('comunidades_autonomas', 'proyectos.ID_AUTONOMIA', '=', 'comunidades_autonomas.ID_COMUNIDAD_AUTONOMA')
            ->join('provincias', 'proyectos.ID_PROVINCIA', '=', 'provincias.ID_PROVINCIA')
            ->join('poblaciones', 'proyectos.ID_POBLACION', '=', 'poblaciones.ID_POBLACION')
            ->get()
            ->toArray();

        return $proyectos;
    }
}
