<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Turnos;

class TurnosController{
    
    public function add(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $turnos = new Turnos();
        $turnos->id_mascota = $data['id_mascota'];
        $turnos->id_veterinario = $data['id_veterinario'];
        $turnos->fecha = $data['fecha'];
        $turnos->hora = $data['hora'];
        
        $rta = json_encode(array("ok" => $turnos->save()));

        $response->getBody()->write($rta);
        return $response;
    }
}