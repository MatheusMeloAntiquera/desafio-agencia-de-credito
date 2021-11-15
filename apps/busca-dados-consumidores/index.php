<?php

require_once "./vendor/autoload.php";

use Dotenv\Dotenv;
use GraphQL\Type\Schema;
use GraphQL\Error\DebugFlag;
use App\Types\ConsumidorQueryType;
use GraphQL\Server\StandardServer;

try {

    //Carrega as váriaveis do .env
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    $server = new StandardServer([
        'schema' => new Schema([
            'query' => new ConsumidorQueryType(),
        ]),
        'context' => ["request" => $_REQUEST],
        'debugFlag' => !empty($_ENV['DEBUG_FLAG']) ? (int) $_ENV['DEBUG_FLAG'] : DebugFlag::INCLUDE_DEBUG_MESSAGE,
    ]);

    $server->handleRequest();
} catch (Throwable $error) {
    echo '<pre>'; print_r($error); echo '</pre>';
    StandardServer::send500Error($error);
}
