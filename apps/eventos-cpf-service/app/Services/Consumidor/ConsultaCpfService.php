<?php

namespace App\Services\Consumidor;

use App\Models\Consumidor;

class ConsultaCpfService
{
    public function executar(string $cpf)
    {

        //Consulta no Cache


        //Consulta no Banco
        return Consumidor::where('cpf', $cpf)->first();
    }
}
