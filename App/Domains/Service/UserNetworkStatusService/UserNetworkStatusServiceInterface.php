<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:24
 */

namespace App\Domains\Service\UserNetworkStatusService;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface UserNetworkStatusServiceInterface
 * @package App\Domains\Service\UserNetworkStatusService
 */
interface UserNetworkStatusServiceInterface
{

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function pushUserToOnline(UserInterface $user);

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function detachUserFromOnline(UserInterface $user);

    /**
     * @return array
     */
    public function getOnlineUsers();

}
