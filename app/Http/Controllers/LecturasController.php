<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturasController extends Controller
{
    public function getValoresLecturaContador1($array){
        $response = array();
        foreach ($array as $contadorId) {
            $month = date('m'); // Obtener el mes actual
            $tableName = 'lecturas_2024_' . str_pad($month, 2, '0', STR_PAD_LEFT); // Construir el nombre de la tabla de lecturas
    
            $lecturas = DB::connection('mysql_monitorizacion')->table($tableName)->selectRaw('ID_LECTURA, ID_CONTADOR, LECTURA, FECHA')->where('ID_CONTADOR', $contadorId)->first();
            
            if ($lecturas) {
                $response[$contadorId] = $lecturas;
            } else {
                $response[$contadorId] = null; // O algún valor de default si no se encuentra la lectura
            }
        }
        return $response;
    }
    
    public function getValoresLecturaContador($array){
        $response = array();
    
        // Iterar sobre cada contador ID
        foreach ($array as $contadorId) {
            $month = date('m'); // Obtener el mes actual
            $lecturas = []; // Array para almacenar las lecturas de todos los meses
    
            // Iterar sobre los meses del año
            for ($m = 1; $m <= 12; $m++) {
                $tableName = 'lecturas_2024_' . str_pad($m, 2, '0', STR_PAD_LEFT); // Construir el nombre de la tabla de lecturas
    
                $mesLecturas = DB::connection('mysql_monitorizacion')->table($tableName)
                    ->selectRaw('ID_LECTURA, ID_CONTADOR, LECTURA, FECHA')
                    ->where('ID_CONTADOR', $contadorId)
                    ->get(); // Obtener todas las lecturas para ese mes y contador
                
                if ($mesLecturas->isNotEmpty()) {
                    $lecturas = array_merge($lecturas, $mesLecturas->toArray()); // Unir las lecturas de cada mes
                }
            }
    
            if (!empty($lecturas)) {
                $response[$contadorId] = $lecturas;
            } else {
                $response[$contadorId] = null; // O algún valor de default si no se encuentran lecturas
            }
        }
    
        return $response;
    }

    public function getDICIEMBRE()
    {
        $response = array();
    
        // Obtener el nombre de la tabla para diciembre de 2024
        $tableName = 'lecturas_2024_12';
    
        // Consulta a la tabla de lecturas de diciembre para todos los contadores
        $lecturas = DB::connection('mysql_moni')->table($tableName)
            ->select('ID_LECTURA', 'ID_CONTADOR', 'LECTURA', 'FECHA')
            ->get(); // Obtener todas las lecturas de diciembre
    
        if ($lecturas->isNotEmpty()) {
            foreach ($lecturas as $lectura) {
                $response[$lectura->ID_CONTADOR] = [
                    'ID_LECTURA' => $lectura->ID_LECTURA,
                    'LECTURA' => $lectura->LECTURA,
                    'FECHA' => $lectura->FECHA,
                ];
            }
        } else {
            // Si no se encuentran lecturas, puedes devolver un array vacío o algún otro valor de default
            $response = [];
        }
    
        return $response;
    }
    
}
