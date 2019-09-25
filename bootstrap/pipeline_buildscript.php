<?php

namespace bootstrap;

use App\Container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Request\Builder\PipelineBuilder\PipelineBuilder;
use App\Request\Builder\PipelineBuilder\PipelineBuilderInterface;
use App\Request\Middleware\AuthenticationMiddleware;

return function (ContainerInterface $container) {

    $middlewares = [];

    $middleware = new AuthenticationMiddleware(
        $container->get('application.entityManager')->getRepository(User::class),
        $container->get(AuthenticationServiceInterface::class)
    );
    $container->set(
        'application.middleware.authentication',
        $middleware
    );
    $middlewares[] = $middleware;
    $skippedActions = [
        'action.user.signup' => [
            AuthenticationMiddleware::class
        ],
        'action.user.signin' => [
            AuthenticationMiddleware::class
        ]
    ];

    $pipelineBuilder = new PipelineBuilder($middlewares, $skippedActions);
    $container->set(PipelineBuilderInterface::class, $pipelineBuilder);
};
