<?php

namespace bootstrap;

use actions\test\NotTest;
use actions\test\Test;
use actions\user\signin\SignIn;
use actions\user\signup\SignUp;
use App\container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Factory\User\UserFactoryInterface;
use App\Request\Validator\ValidatorInterface;

return function (ContainerInterface $container) {
    $container->set('action.test', function (ContainerInterface $container) {
        return new Test(
            $container->get('application.config'),
            $container->get('application.entityManager')->getRepository(User::class)
        );
    });
    $container->set('action.test2', NotTest::class);
    $container->set('action.user.signup', function (ContainerInterface $container) {
        return new SignUp(
            $container->get('application.entityManager')->getRepository(User::class),
            $container->get(UserFactoryInterface::class),
            $container->get(ValidatorInterface::class)
        );
    });
    $container->set('action.user.signin', function (ContainerInterface $container) {
        return new SignIn(
            $container->get('application.entityManager')->getRepository(User::class),
            $container->get(AuthenticationServiceInterface::class)
        );
    });
};
