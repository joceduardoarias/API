<?php
namespace App\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AfterMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  ServerRequest  $request PSR-7 request
     * @param  RequestHandler $handler PSR-15 request handler
     *
     * @return Response
     */
    public function __invoke(Request $request, RequestHandler $handler): Response
    {   
        //Tomo el header para manipularlo
        $response = $handler->handle($request);

        //Devuelve el header en formato JSON / Todas las respuestas de la aplicación ahora son JSON
        $response = $response->withHeader('Content-type', 'application/json');
        
        return $response;
    }
}
