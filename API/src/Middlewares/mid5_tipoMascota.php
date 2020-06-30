<?php
namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use App\Utils\tipoMascotaValidacion;

class TipoMascotaMiddleware
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
        
        $tpmValidacion = new tipoMascotaValidacion();
        $jwt =$request->getHeader('token');
        $valido = $tpmValidacion->tipoMascotaValidacion($request,$jwt);

        if ($valido) {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
            $resp = new Response();
            $resp->getBody()->write($existingContent);
        }else {
            $response = new Response();
            throw new \Slim\Exception\HttpForbiddenException($request);
            return $response->withStatus(403);
        }
        
        
        return $response;
    }
}
