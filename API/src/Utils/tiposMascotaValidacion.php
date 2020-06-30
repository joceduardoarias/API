<?php

namespace App\Utils;
use App\Models\Tipo_mascota;
use \Firebase\JWT\JWT;

class tipoMascotaValidacion{

    public function tipoMascotaValidacion($request,$token)
    {
        $data = $request->getParsedBody();
        $jwt =$token;
        $key ="pro3-parcial";
        $jwtDecoded = JWT::decode($jwt[0],$key,array('HS256'));
       
       $retVal = ($jwtDecoded->tipo = 1) ? true : false ; 
         
       return $retVal;                                        
    }
}