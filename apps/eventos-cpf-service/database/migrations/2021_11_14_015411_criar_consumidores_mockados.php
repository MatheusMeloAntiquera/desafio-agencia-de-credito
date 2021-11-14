<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarConsumidoresMockados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('consumidor')->insert([
            'cpf' => "62571675079",
            'ultima_consulta' => [
                'bureau' => 'Serasa',
                'data_hora' => '2021-11-10 22:59:54'
            ],
            'movimentacoes_financeiras' => [
                [
                    'acao' => 'compra',
                    'valor' => 200.4
                ],
                [
                    'acao' => 'recebimento',
                    'valor' => 50
                ]
            ],
            'ultima_compra_cartao' => [
                'cartao' => '454565657878989',
                'valor' => 20,
                'recebedor' => 'Ifood',
                'data_hora' => '2021-10-21 20:00:00'
            ]
        ]);

        DB::table('consumidor')->insert([
            'cpf' => '26776507031',
            'ultima_consulta' => [
                'bureau' => 'Serasa',
                'data_hora' => '2021-08-23 11:45:01'
            ],
            'movimentacoes_financeiras' => [
                [
                    'acao' => 'compra',
                    'valor' => 50
                ],
                [
                    'acao' => 'compra',
                    'valor' => 150.99
                ],
                [
                    'acao' => 'compra',
                    'valor' => 5.56
                ]
            ],
            'ultima_compra_cartao' => [
                'cartao' => '5401484045829090',
                'valor' => 1500,
                'recebedor' => 'Magazine Luiza',
                'data_hora' => '2021-11-11 18:30:00'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Todo: deletar os consumidores criados acima
    }
}
