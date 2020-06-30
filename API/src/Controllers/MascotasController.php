<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Mascotas;

class MascotasController{

    public function add(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $mascota = new Mascotas();
        $mascota->nombre = $data['nombre'];
        $mascota->fecha_nacimiento = $data['fecha_nacimiento'];
        $mascota->cliente_id = $data['cliente_id'];
        $mascota->tipo_mascota_id = $data['tipo_mascota_id'];

        $rta = json_encode(array("ok" => $mascota->save()));

        $response->getBody()->write($rta);
        return $response;
    }
}