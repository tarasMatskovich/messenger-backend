<?php

namespace bootstrap;

use actions\auth\CheckAuth;
use actions\message\create\CreateMessage;
use actions\session\create\CreateSession;
use actions\session\getlist\GetSessionsList;
use actions\test\NotTest;
use actions\test\Test;
use actions\user\getlist\GetUsersList;
use actions\user\signin\SignIn;
use actions\user\signup\SignUp;
use App\container\ContainerInterface;
use App\Domains\Entities\Message\Message;
use App\Domains\Entities\Session\Session;
use App\Domains\Entities\User\User;
use App\Domains\Responder\Session\SessionResponder;
use App\Domains\Responder\User\UserResponder;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Domains\Service\MessageService\MessageServiceInterface;
use App\Domains\Service\StorageService\StorageServiceInterface;
use App\Factory\Message\MessageFactoryInterface;
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
    $container->set('action.auth.check', new CheckAuth());
    $container->set('action.user.getlist', function (ContainerInterface $container) {
        return new GetUsersList(
            $container->get('application.entityManager')->getRepository(User::class),
            new UserResponder($container->get(StorageServiceInterface::class))
        );
    });
    $container->set('action.session.getlist', function (ContainerInterface $container) {
        return new GetSessionsList(
            $container->get('application.entityManager')->getRepository(User::class),
            $container->get('application.entityManager')->getRepository(Session::class),
            new SessionResponder(
                $container->get('application.entityManager')->getRepository(User::class),
                $container->get('application.entityManager')->getRepository(Message::class),
                $container->get(StorageServiceInterface::class)
            ),
            new UserResponder(
                $container->get(StorageServiceInterface::class)
            )
        );
    });
    $container->set('action.session.create', function (ContainerInterface $container) {
        return new CreateSession(
            $container->get('application.entityManager')->getRepository(Session::class)
        );
    });
    $container->set('action.message.create', function (ContainerInterface $container) {
        return new CreateMessage(
            $container->get('application.entityManager')->getRepository(Message::class),
            $container->get('application.entityManager')->getRepository(User::class),
            $container->get('application.entityManager')->getRepository(Session::class),
            $container->get(MessageFactoryInterface::class),
            $container->get(MessageServiceInterface::class)
        );
    });
};
