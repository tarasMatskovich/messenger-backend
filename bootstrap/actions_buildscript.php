<?php

namespace bootstrap;

use actions\test\NotTest;
use actions\test\Test;
use App\container\ContainerInterface;

return function (ContainerInterface $container) {
    $container->set('action.test', function (ContainerInterface $container) {
        return new Test(
            $container->get('application.config')
        );
    });
    $container->set('action.test2', NotTest::class);
};