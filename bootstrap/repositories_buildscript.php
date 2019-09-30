<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 18:40
 */

namespace bootstrap;

use App\Container\ContainerInterface;
use App\Domains\Entities\Message\Message;
use App\Domains\Entities\Session\Session;
use App\Domains\Entities\User\User;
use App\Domains\Repository\Message\MessageRepositoryInterface;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;

return function (ContainerInterface $container) {
    $container->set(UserRepositoryInterface::class, $container->get('application.entityManager')->getRepository(User::class));
    $container->set(SessionRepositoryInterface::class, $container->get('application.entityManager')->getRepository(Session::class));
    $container->set(MessageRepositoryInterface::class, $container->get('application.entityManager')->getRepository(Message::class));
};
