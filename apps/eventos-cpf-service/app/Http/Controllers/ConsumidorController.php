<?php

namespace App\Http\Controllers;

use App\Services\Consumidor\ConsultaCpfService;
use Illuminate\Http\Request;


class ConsumidorController extends Controller
{
    public function consultaCpf(Request $request, ConsultaCpfService $service){

        if(!empty($dadosConsumidor = $service->executar($request->input("cpf")))){
            return response()->json([
                "sucesso" => true,
                "dados" => $dadosConsumidor
            ]);
        }

        return response()->json([
            "sucesso" => false,
            "msg" => "Dados referente ao CPF não encontrado"
        ]);
    }
}
