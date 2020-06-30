<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Utils\Login;

class LoginController{
    public function addLogin(Request $request, Response $response, $args)
    {
        $datos = $request->getParsedBody();
        var_dump($datos);
        $login = new Login();
        $token = $login->loginToken($datos);
        
        $response->getBody()->write($token);

        return $response;
    }
}