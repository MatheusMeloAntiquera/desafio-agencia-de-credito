<?php

namespace App\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class QueryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'consumidor' => [
                    'type' => new ConsumidorType(),
                    'description' => 'Retorna dados do consumidor por CPF',
                ],
            ],
            'resolveField' => function ($user, $args, $context, ResolveInfo $info) {
                $fieldName = $info->fieldName;
                echo '<pre>'; print_r($fieldName); echo '</pre>'; exit;
                return $context;
                $method = 'resolve' . ucfirst($fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($user, $args, $context, $info);
                }

                return $user->{$fieldName};
            },
        ]);
    }
}
