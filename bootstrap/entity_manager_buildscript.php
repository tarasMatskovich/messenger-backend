<?php

namespace bootstrap;

use App\Container\ContainerInterface;
use App\Domains\Service\Config\ConfigInterface;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PDO;


return function (ContainerInterface $container) {
    /**
     * @var ConfigInterface $config
     */
    $config = $container->get('application.config');
    $paths = array(
        ROOT . '/App/Domains/Entities/User'
    );
    $isDevMode = true;

    $dbParams = array(
        'driver'   => $config->get('database:driver'),
        'user'     => $config->get('database:login'),
        'password' => $config->get('database:password'),
        'host' => $config->get('database:host'),
        'port' => $config->get('database:port'),
        'dbname'   => $config->get('database:db_name'),
    );
    $dsn = "mysql:host={$config->get('database:host')};dbname={$config->get('database:db_name')}";
    $opt = [
        1005=>1024*1024*50
    ];
    $pdo = new PDO($dsn, $config->get('database:login'), $config->get('database:password'), $opt);
    $dbParams = [
        'pdo' => $pdo
    ];

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);

    $container->set('application.entityManager', function (ContainerInterface $container) use ($entityManager) {
        return $entityManager;
    });
};
