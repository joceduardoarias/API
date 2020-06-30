<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Usuarios;

class UsuariosController{

    public function add(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $usuario = new Usuarios();
        $usuario->email = $data['email'];
        $usuario->tipo = $data['tipo'];
        $usuario->clave = $data['clave'];
        $usuario->usuario = $data['usuario'];
        
        $rta = json_encode(array("ok" => $usuario->save()));

        $response->getBody()->write($rta);

        return $response;
    }

}