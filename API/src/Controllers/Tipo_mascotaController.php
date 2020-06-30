<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\tipo_mascota;

class Tipo_mascotaController{

    public function add(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $Tipo_mascota = new tipo_mascota();
       
        $Tipo_mascota->tipo = $data['tipo'];
        
        
        $rta = json_encode(array("ok" => $Tipo_mascota->save()));

        $response->getBody()->write($rta);

        return $response;
    }

}