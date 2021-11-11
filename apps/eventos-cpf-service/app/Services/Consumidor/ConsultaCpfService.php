<?php

namespace App\Services\Consumidor;

use App\Models\Consumidor;
use Illuminate\Support\Facades\Cache;

class ConsultaCpfService
{
    public function executar(string $cpf): \App\Models\Consumidor | null
    {
        //Consulta no Cache
        return Cache::get($cpf, function () use ($cpf) {
            //Consulta no Banco e cria o cache
            if (!empty($dados = Consumidor::where('cpf', $cpf)->first())) {
                Cache::put($cpf, $dados, now()->addMinutes(
                    env("REDIS_CPF_EXPIRACAO_MINUTOS", 2)
                ));
            }
            return $dados;
        });
    }
}
