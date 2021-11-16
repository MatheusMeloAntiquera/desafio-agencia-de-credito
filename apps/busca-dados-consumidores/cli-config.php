<?php
/**
 * Esse arquivo serve para poder usar o doctrine no terminal para facilitar o desenvolvimento
 */

use App\Entities\GerenciadorDeEntidades;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet((new GerenciadorDeEntidades())->getEntityManager());