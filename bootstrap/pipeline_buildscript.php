<?php

namespace bootstrap;

use App\Container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Request\Builder\PipelineBuilder\PipelineBuilder;
use App\Request\Builder\PipelineBuilder\PipelineBuilderInterface;
use App\Request\Middleware\AuthenticationMiddleware;

return function (ContainerInterface $container) {

    $middlewares = [];

    $middleware = new AuthenticationMiddleware(
        $container->get('application.entityManager')->getRepository(User::class)
    );
    $container->set(
        'application.middleware.authentication',
        $middleware
    );
    $middlewares[] = $middleware;

    $pipelineBuilder = new PipelineBuilder($middlewares);
    $container->set(PipelineBuilderInterface::class, $pipelineBuilder);
};
