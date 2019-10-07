<?php

namespace Config\container;

use App\Container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Domains\Responder\Message\MessageResponder;
use App\Domains\Responder\User\UserResponder;
use App\Domains\Service\AuthenticationService\AuthenticationService;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Domains\Service\Config\Config;
use App\Domains\Service\Config\ConfigInterface;
use App\Domains\Service\JWTService\JWTService;
use App\Domains\Service\JWTService\JWTServiceInterface;
use App\Domains\Service\MessageService\MessageService;
use App\Domains\Service\MessageService\MessageServiceInterface;
use App\Domains\Service\StorageService\StorageService;
use App\Domains\Service\StorageService\StorageServiceInterface;
use App\Domains\Service\UserPassword\UserPasswordService;
use App\Domains\Service\UserPassword\UserPasswordServiceInterface;
use App\Factory\ApplicationFactory;
use App\Factory\ApplicationFactoryInterface;
use App\Factory\Message\MessageFactory;
use App\Factory\Message\MessageFactoryInterface;
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
        UserFactoryInterface::class => UserFactory::class,
        UserPasswordServiceInterface::class => UserPasswordService::class,
        JWTServiceInterface::class => function (ContainerInterface $container) {
            return new JWTService($container->get('application.config')->get('security:jwt:secret'));
        },
        AuthenticationServiceInterface::class => AuthenticationService::class,
        StorageServiceInterface::class => function (ContainerInterface $container) {
            return new StorageService($container->get('application.config')->get('storage:public'));
        },
        MessageFactoryInterface::class => MessageFactory::class,
        MessageServiceInterface::class => function (ContainerInterface $container) {
            return new MessageService(
                $container->get('application.clientSession'),
                new MessageResponder(
                    new UserResponder(
                        $container->get(StorageServiceInterface::class)
                    ),
                    $container->get('application.entityManager')->getRepository(User::class)
                )
            );
        }
    ],
    'singletons' => [

    ]
];
