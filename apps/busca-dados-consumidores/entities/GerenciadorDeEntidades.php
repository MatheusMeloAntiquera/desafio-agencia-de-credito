<?php

namespace App\Entities;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class GerenciadorDeEntidades
{
    protected $entityManager;
    public function __construct()
    {
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        // replace with mechanism to retrieve EntityManager in your app
        // database configuration parameters
        $conn = array(
            'driver' => 'pdo_pgsql',
            'host' => 'postgres',
            'dbname' => 'base_a',
            'user' => 'postgres',
            'password' => 'teste', // change to your password
        );

        // obtaining the entity manager
        $this->entityManager = EntityManager::create($conn, $config);
    }

    public function getEntityManager(): EntityManager
    {
        return $this->entityManager;
    }
}
