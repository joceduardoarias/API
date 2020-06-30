<?php

namespace App\Utils;
use App\Models\Usuarios;


class RegistroValidacion{

    public function RegistroValidacion($request)
    {
        $data = $request->getParsedBody();
        
        $cantidad = json_encode(Usuarios::where("email","=",$data['email'])->count());
         $retVal = ($cantidad!=0) ? false : true ;   
         return $retVal;                                        
    }
}