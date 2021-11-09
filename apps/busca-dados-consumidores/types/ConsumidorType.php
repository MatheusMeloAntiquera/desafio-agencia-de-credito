<?php

namespace App\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class ConsumidorType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Consumidor',
            'description' => 'Nosso consumidores',
            'fields' => static fn (): array => [
                'cpf' => Type::string(),
                'nome' => Type::string(),
                'endereco' => Type::string(),
            ],
            'resolveField' => function ($user, $args, $context, ResolveInfo $info) {
                echo '<pre>'; print_r($user); echo '</pre>'; exit;
                $fieldName = $info->fieldName;

                $method = 'resolve' . ucfirst($fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($user, $args, $context, $info);
                }

                return $user->{$fieldName};
            },
        ]);
    }
}