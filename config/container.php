<?php

namespace Config\container;

use App\Container\ContainerInterface;
use App\Domains\Service\Config\Config;
use App\Domains\Service\Config\ConfigInterface;
use App\Factory\ApplicationFactory;
use App\Factory\ApplicationFactoryInterface;
use App\Factory\User\UserFactory;
use App\Factory\User\UserFactoryInterface;
use App\Request\Builder\RequestBuilder;
use App\Request\Builder\RequestBuilderInterface;
use App\Request\Validator\Validator;
use App\Request\Validator\ValidatorInterface;
use App\Router\Factory\RouterFactory;
use App\Router\Factory\RouterFactoryInterface;
use App\Router\HttpRouter;
use App\Router\HttpRouterInterface;
use App\Router\Router;
use App\Router\RouterInterface;

return [
    'definitions' => [
        ApplicationFactoryInterface::class => ApplicationFactory::class,
        RequestBuilderInterface::class => RequestBuilder::class,
        RouterFactoryInterface::class => RouterFactory::class,
        HttpRouterInterface::class => HttpRouter::class,
        RouterInterface::class => Router::class,
        "application.config" => function () {
            $path = ROOT . '/config/config.current.php';
            return new Config($path);
        },
        ValidatorInterface::class => Validator::class,
        UserFactoryInterface::class => UserFactory::class
    ],
    'singletons' => [

    ]
];
