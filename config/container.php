<?php

namespace Config\container;

use App\Container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Domains\Responder\Message\MessageResponder;
use App\Domains\Responder\User\UserResponder;
use App\Domains\Service\AuthenticationService\AuthenticationService;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Domains\Service\Base32EncoderService\Base32FixedNotationEncoder;
use App\Domains\Service\Base32EncoderService\Base32Interface;
use App\Domains\Service\Config\Config;
use App\Domains\Service\Config\ConfigInterface;
use App\Domains\Service\GoogleAuthenticatorService\AlwaysNewGoogleAuthenticator;
use App\Domains\Service\GoogleAuthenticatorService\GoogleAuthenticatorService;
use App\Domains\Service\GoogleAuthenticatorService\GoogleAuthenticatorServiceInterface;
use App\Domains\Service\JWTService\JWTService;
use App\Domains\Service\JWTService\JWTServiceInterface;
use App\Domains\Service\MessageService\MessageService;
use App\Domains\Service\MessageService\MessageServiceInterface;
use App\Domains\Service\StorageService\StorageService;
use App\Domains\Service\StorageService\StorageServiceInterface;
use App\Domains\Service\UserNetworkStatusService\UserNetworkStatusService;
use App\Domains\Service\UserNetworkStatusService\UserNetworkStatusServiceInterface;
use App\Domains\Service\UserPassword\UserPasswordService;
use App\Domains\Service\UserPassword\UserPasswordServiceInterface;
use App\Domains\Service\UserTOTPService\UserTOTPService;
use App\Domains\Service\UserTOTPService\UserTOTPServiceInterface;
use App\EventListener\EventListener;
use App\EventListener\EventListenerInterface;
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
        EventListenerInterface::class => function () {
            $channels = require ROOT . '/config/channels.php';
            return new EventListener(
                $channels
            );
        },
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
        },
        Base32Interface::class => Base32FixedNotationEncoder::class,
        GoogleAuthenticatorServiceInterface::class => function (ContainerInterface $container) {
            return new GoogleAuthenticatorService(
                new AlwaysNewGoogleAuthenticator()
            );
        },
        UserTOTPServiceInterface::class => function (ContainerInterface $container) {
            return new UserTOTPService(
              $container->get(GoogleAuthenticatorServiceInterface::class),
              $container->get(Base32Interface::class),
              $container->get('application.config')->get('security:secondFactor:salt'),
              'Messenger'
            );
        }
    ],
    'singletons' => [
        UserNetworkStatusServiceInterface::class => new UserNetworkStatusService()
    ]
];
