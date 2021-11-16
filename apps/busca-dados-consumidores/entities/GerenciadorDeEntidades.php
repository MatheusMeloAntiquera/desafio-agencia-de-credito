<?php

namespace App\Entities;

use Dotenv\Dotenv;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class GerenciadorDeEntidades
{
    protected $entityManager;
    public function __construct()
    {
        //Carrega as váriaveis do .env
        $dotenv = Dotenv::createImmutable(__DIR__."/../");
        $dotenv->load();

        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        $parametrosConexao = array(
            'driver' => self::env('DB_DRIVER','pdo_pgsql'),
            'host' => self::env('DB_HOST','127.0.0.1'),
            'port' => self::env('DB_PORT', 5432),
            'dbname' => self::env('DB_NAME','postgres'),
            'user' => self::env('DB_USER','postgres'),
            'password' => self::env('DB_PASS','')
        );

        // obtaining the entity manager
        $this->entityManager = EntityManager::create($parametrosConexao, $config);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }

    private static function env(string $chave, $valorPadrao)
    {
        return !empty($_ENV[$chave]) ? $_ENV[$chave] : $valorPadrao;
    }
}
