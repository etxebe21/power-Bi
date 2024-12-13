<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\EdificiosController;
use App\Http\Controllers\ViviendasController;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function proyectos()
    {
        // Consulta a la base de datos para obtener proyectos, direcciones y pisos
        $proyectos = DB::table('proyectos')
            ->join('edificios', 'proyectos.ID_PROYECTO', '=', 'edificios.ID_PROYECTO')
            ->join('ficha_edificio', 'edificios.ID_EDIFICIO', '=', 'ficha_edificio.ID_EDIFICIO')
            ->join('viviendas', 'edificios.ID_EDIFICIO', '=', 'viviendas.ID_EDIFICIO')
            ->select(
                'proyectos.ID_PROYECTO',
                'proyectos.NOMBRE_PROYECTO',
                'ficha_edificio.DIRECCION', // Dirección obtenida de ficha_edificio
                'viviendas.PISO'
            )
            ->get();

        // Agrupar datos por proyectos
        $proyectosAgrupados = $proyectos->groupBy('ID_PROYECTO')->map(function ($viviendas, $idProyecto) {
            return [
                'ID_PROYECTO' => $idProyecto,
                'NOMBRE_PROYECTO' => $viviendas->first()->NOMBRE_PROYECTO,
                'edificios' => $viviendas->groupBy('DIRECCION')->map(function ($pisos, $direccion) {
                    return [
                        'DIRECCION' => $direccion,
                        'viviendas' => $pisos->map(function ($piso) {
                            return [
                                'PISO' => $piso->PISO,
                            ];
                        }),
                    ];
                })->values(),
            ];
        })->values();

        // Enviar los datos estructurados a la vista de Inertia
        return Inertia::render('Proyectos/Index', [
            'proyectos' => $proyectosAgrupados,
        ]);
    }
}

