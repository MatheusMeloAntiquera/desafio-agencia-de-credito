<?php

require_once "./vendor/autoload.php";

use GraphQL\Type\Schema;
use App\Types\ConsumidorQueryType;
use GraphQL\Server\StandardServer;
use GraphQL\Error\DebugFlag;

try {
    $server = new StandardServer([
        'schema' => new Schema([
            'query' => new ConsumidorQueryType(),
        ]),
        'context' => ["request" => $_REQUEST],
        'debugFlag' => DebugFlag::INCLUDE_TRACE | DebugFlag::INCLUDE_DEBUG_MESSAGE
    ]);

    $server->handleRequest();
} catch (Throwable $error) {
    StandardServer::send500Error($error);
}
