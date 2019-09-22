<?php

use App\ApplicationLauncher;
use App\Container\Container;
use App\Factory\ApplicationFactoryInterface;
use App\Factory\Enum\ApplicationTypesEnum;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('ROOT', dirname(__FILE__));

require './vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

$definitions = require './config/container.php';

$container = new Container($definitions);

$buildKey = ApplicationTypesEnum::APP_WAMP;

/**
 * @var \App\Factory\ApplicationFactoryInterface $appFactory
 */
$appFactory = $container->get(ApplicationFactoryInterface::class);

$app = new ApplicationLauncher($buildKey, $appFactory, $container);
$app->launch();
