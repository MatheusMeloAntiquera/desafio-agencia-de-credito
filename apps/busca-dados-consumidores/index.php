<?php

require_once "./vendor/autoload.php";

use GraphQL\GraphQL;
use App\Types\QueryType;
use GraphQL\Type\Schema;
use App\Types\ConsumidorType;
use GraphQL\Type\Definition\Type;
use GraphQL\Server\StandardServer;
use GraphQL\Type\Definition\ObjectType;

try {

    // See docs on schema options:
    // https://webonyx.github.io/graphql-php/type-system/schema/#configuration-options
    $schema = new Schema([
        'query' => new ConsumidorType(),
        // 'typeLoader' => static fn (string $name): Type => Types::byTypeName($name),
    ]);

    // // Prepare context that will be available in all field resolvers (as 3rd argument):
    // $appContext          = new AppContext();
    // $appContext->viewer  = DataSource::findUser(1); // simulated "currently logged-in user"
    // $appContext->rootUrl = 'http://localhost:8000';
    // $appContext->request = $_REQUEST;

    // See docs on server options:
    // https://webonyx.github.io/graphql-php/executing-queries/#server-configuration-options
    $server = new StandardServer([
        'schema' => $schema,
        'context' => ["request" => $_REQUEST],
    ]);

    $server->handleRequest();
} catch (Throwable $error) {
    echo '<pre>'; print_r($error); echo '</pre>';
    StandardServer::send500Error($error);
}