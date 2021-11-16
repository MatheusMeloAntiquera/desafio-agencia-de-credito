<?php

namespace App\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class ConsumidorType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Consumidor',
            'description' => 'Dados dos consumidores',
            'fields' => static fn (): array => [
                'cpf' => Type::string(),
                'nome' => Type::string(),
                'endereco' => Type::string(),
            ],
        ]);
    }
}