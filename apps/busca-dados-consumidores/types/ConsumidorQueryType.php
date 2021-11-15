<?php

namespace App\Types;

use App\Entities\Consumidor;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Entities\GerenciadorDeEntidades;

class ConsumidorQueryType extends ObjectType
{
    public function __construct()
    {
        $consumidorRepository = (new GerenciadorDeEntidades())
            ->getEntityManager()
            ->getRepository(Consumidor::class);

        parent::__construct([
            'name' => 'Busca Dados Consumidor',
            'fields' => [
                'consumidor' => [
                    'type' => new ConsumidorType(),
                    'description' => 'Retorna dados do consumidor por CPF',
                    'args' => [
                        'cpf' => [
                            'type' => Type::string()
                        ]
                    ],
                    'resolve' => function ($objectValue, $args) use ($consumidorRepository) {
                        return $consumidorRepository->findOneBy(["cpf" => $args["cpf"]]);
                    },
                ],
            ]
        ]);
    }
}
