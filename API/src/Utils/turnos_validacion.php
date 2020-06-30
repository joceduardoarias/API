<?php

namespace App\Utils;
use App\Models\Turnos;


class TurnosValidacion{

    public function TurnosValidar($request)
    {
        $data = $request->getParsedBody();
        $turnos = new Turnos();
        $turnos->mascota_id = $data['id_mascota'];
        $turnos->veterinario_id = $data['id_veterinario'];
        $turnos->fecha = $data['fecha'];
                               
        
        $firsTime = "09:00:00";
        $endTime = "17:00:00";
        
        if (strtotime($data['fecha']) >= strtotime($firsTime) && strtotime($data['fecha'])  <= strtotime($endTime)) {
            $cantidad = json_encode(Turnos::where('hora','=',$turnos->fecha)->count());
            if($cantidad<2){
                $cantidad = json_encode(Turnos::where('fecha','=',$turnos->fecha)
                                            ->where('id_veterinario','=',$turnos->id_veterinario)->count());
                if($cantidad<1){
                    return true;
                }                                
            }else {
                return false;
            }
        }else {
           return false;
        }
    }
}