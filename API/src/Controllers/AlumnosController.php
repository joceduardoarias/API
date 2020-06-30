<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Alumno;//Traemos en name space para instanciar y utilizar el ORM
//Ahora el cotrolador recibe la llamada y se comunica con el modelo y modelo ejecuta los metodos del ORM
class AlumnosController {

    //Traes todos los registros de una tabla
    public function getAll(Request $request, Response $response, $args)
    {
        $rta = json_encode(Alumno::all());

        // $response->getBody()->write("Controller");
        $response->getBody()->write($rta);

        return $response;
    }
    //agregar un resgistro a la tabla
    public function add(Request $request, Response $response, $args)
    {
        $alumno = new Alumno;
        $alumno->alumno = "Eloquent";
        $alumno->legajo = 4201;
        $alumno->localidad = 1;
        $alumno->cuatrimestre = 1;
        
        $rta = json_encode(array("ok" => $alumno->save()));

        $response->getBody()->write($rta);

        return $response;
    }
}