<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedidoresController extends Controller
{
    //obtener ultima lectura idcontador
    public function getValoresLecturaContador($array){
        $response = array();
        $lecturas = DB::table('medidores')->selectRaw('ID_MEDIDOR, TIPO_MEDIDOR, ID_DISPOSITIVO, ID_VIVIENDA, ULTIMA_LECTURA, FECHA_ULTIMA_LECTURA, DESCRIPCION')->whereIn('ID_MEDIDOR', $array)->get();
        foreach($lecturas as $lectura){
            $index = array_search($lectura->ID_CONTADOR, $array);
            $response[$index]=$lectura;
        }
        return $lecturas;
    }

    public function getMedidores(){
        $listavinculaciones = array();
        $medidores =  DB::table('medidores')
        ->join('viviendas', 'medidores.ID_VIVIENDA', 'viviendas.ID_VIVIENDA')
        ->join('edificios', 'viviendas.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
        ->join('ficha_edificio', 'ficha_edificio.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
        ->join('proyectos', 'edificios.ID_PROYECTO', 'proyectos.ID_PROYECTO')
        ->join('medidores_tipos', 'medidores.TIPO_MEDIDOR', 'medidores_tipos.ID_TIPO_MEDIDOR')
        ->get();
        // foreach($medidores as $medidor){
        //     if($medidor->ID_DISPOSITIVO!=null){
        //         $listavinculaciones[$medidor->ID_MEDIDOR]=$medidor->ID_DISPOSITIVO;
        //     }
        // }
        // $valorescontadores = $this->getValoresLecturaContador($listavinculaciones);
        // foreach($medidores as $medidor){
        //     if(isset($valorescontadores[$medidor->ID_MEDIDOR])){
        //         $medidor->ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->ULTIMA_LECTURA;
        //         $medidor->FECHA_ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->FECHA;
        //     }
        // }
        // print_r($medidores);
        return $medidores;
    }

    public function getMedidoresProyecto($ID_PROYECTO) {
        $listavinculaciones = array();
        $medidores = DB::table('medidores')
            ->join('viviendas', 'medidores.ID_VIVIENDA', 'viviendas.ID_VIVIENDA')
            ->join('edificios', 'viviendas.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
            ->join('ficha_edificio', 'ficha_edificio.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
            ->join('proyectos', 'edificios.ID_PROYECTO', 'proyectos.ID_PROYECTO')
            ->join('medidores_tipos', 'medidores.TIPO_MEDIDOR', 'medidores_tipos.ID_TIPO_MEDIDOR')
            ->where('proyectos.ID_PROYECTO', $ID_PROYECTO)
            ->get();
        foreach($medidores as $medidor){
            if($medidor->ID_DISPOSITIVO!=null){
                $listavinculaciones[$medidor->ID_MEDIDOR]=$medidor->ID_DISPOSITIVO;
            }
        }
        $valorescontadores = $this->getValoresLecturaContadoor($listavinculaciones);
        foreach($medidores as $medidor){
            if(isset($valorescontadores[$medidor->ID_MEDIDOR])){
                $medidor->ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->ULTIMA_LECTURA;
                $medidor->FECHA_ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->FECHA;
            }
        }
        return $medidores;
    }

    public function getMedidoresEdificio($ID_EDIFICIO)
    {
        $listavinculaciones = array();
        $medidores = DB::table('medidores')
            ->join('viviendas', 'medidores.ID_VIVIENDA', '=', 'viviendas.ID_VIVIENDA')
            ->join('edificios', 'viviendas.ID_EDIFICIO', '=', 'edificios.ID_EDIFICIO')
            ->join('ficha_edificio', 'ficha_edificio.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
            ->join('medidores_tipos', 'medidores.TIPO_MEDIDOR', '=', 'medidores_tipos.ID_TIPO_MEDIDOR')
            ->where('viviendas.ID_EDIFICIO', $ID_EDIFICIO)
            ->get();
            foreach($medidores as $medidor){
                if($medidor->ID_DISPOSITIVO!=null){
                    $listavinculaciones[$medidor->ID_MEDIDOR]=$medidor->ID_DISPOSITIVO;
                }
            }
            $valorescontadores = $this->getValoresLecturaContadoor($listavinculaciones);
            foreach($medidores as $medidor){
                if(isset($valorescontadores[$medidor->ID_MEDIDOR])){
                    $medidor->ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->ULTIMA_LECTURA;
                    $medidor->FECHA_ULTIMA_LECTURA=$valorescontadores[$medidor->ID_MEDIDOR]->FECHA;
                }
            }
            return $medidores;
    }

    public function getMedidoresVivienda($ID_VIVIENDA) {
        return DB::table('medidores')
            ->join('medidores_tipos', 'medidores.TIPO_MEDIDOR', 'medidores_tipos.ID_TIPO_MEDIDOR')
            ->join('viviendas', 'medidores.ID_VIVIENDA', '=', 'viviendas.ID_VIVIENDA')
            ->join('edificios', 'viviendas.ID_EDIFICIO', '=', 'edificios.ID_EDIFICIO')
            ->join('ficha_edificio', 'ficha_edificio.ID_EDIFICIO', 'edificios.ID_EDIFICIO')
            ->where('medidores.ID_VIVIENDA', $ID_VIVIENDA)
            ->get();
    }

    public function getUltimaLectura($ID_CONTADOR)
    {
        $ultimaLectura = DB::connection('mysql_monitorizacion')
            ->table('contadores')
            ->where('ID_CONTADOR', $ID_CONTADOR)
            ->first();

        if ($ultimaLectura) {
            $ultimaLectura = array(
                'LECTURA' => $ultimaLectura->ULTIMA_LECTURA,
                'DIA' => $ultimaLectura->FECHA,
                'ID_CONTADOR' => $ultimaLectura->ID_CONTADOR
            );
        } else {
            $ultimaLectura = null;
        }
        return $ultimaLectura;
    }

    public function getInfoMedidor($ID_MEDIDOR){
        return DB::table('medidores')
            ->join('medidores_tipos', 'medidores_tipos.ID_TIPO_MEDIDOR', 'medidores.TIPO_MEDIDOR')
            ->join('viviendas', 'viviendas.ID_VIVIENDA', 'medidores.ID_VIVIENDA')
            ->where('ID_MEDIDOR', $ID_MEDIDOR)
            ->first();
    }

    public function getTipoMedidor($ID_DISPOSITIVO){
        return DB::table('medidores')
            ->join('medidores_tipos', 'medidores_tipos.ID_TIPO_MEDIDOR', 'medidores.TIPO_MEDIDOR')
            ->where('ID_DISPOSITIVO', $ID_DISPOSITIVO)
            ->first();
    }
}
