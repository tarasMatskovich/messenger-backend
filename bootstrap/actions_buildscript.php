<?php

namespace bootstrap;

use actions\test\NotTest;
use actions\test\Test;
use App\container\ContainerInterface;
use App\Domains\Entities\User\User;

return function (ContainerInterface $container) {
    $container->set('action.test', function (ContainerInterface $container) {
        return new Test(
            $container->get('application.config'),
            $container->get('application.entityManager')->getRepository(User::class)
        );
    });
    $container->set('action.test2', NotTest::class);
};