<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:17
 */

namespace bootstrap;

use App\Container\ContainerInterface;
use App\Domains\Entities\User\User;
use App\Domains\Service\UserNetworkStatusService\UserNetworkStatusServiceInterface;
use listeners\application\network\detach\DetachUserStatus;
use listeners\application\network\status\UserStatusListener;

return function (ContainerInterface $container) {

    $container->set('application.network.status', function (ContainerInterface $container) {
        return new UserStatusListener(
            $container->get(UserNetworkStatusServiceInterface::class),
            $container->get('application.entityManager')->getRepository(User::class)
        );
    });
    $container->set('application.network.detach.status', function (ContainerInterface $container) {
        return new DetachUserStatus(
            $container->get(UserNetworkStatusServiceInterface::class),
            $container->get('application.entityManager')->getRepository(User::class)
        );
    });

};
