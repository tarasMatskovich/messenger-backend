<?php

namespace App\Factory;

use App\ApplicationInterface;
use App\Container\ContainerInterface;
use App\Router\RouterInterface;

interface ApplicationFactoryInterface
{

    /**
     * @param string $applicationType
     * @param ContainerInterface $container
     * @param RouterInterface $router
     * @return ApplicationInterface
     */
    public function make(string $applicationType, ContainerInterface $container, RouterInterface $router);

}