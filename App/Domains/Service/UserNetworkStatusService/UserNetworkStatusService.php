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
 * Class UserNetworkStatusService
 * @package App\Domains\Service\UserNetworkStatusService
 */
class UserNetworkStatusService implements UserNetworkStatusServiceInterface
{

    /**
     * @var array
     */
    private $onlineUsers;

    /**
     * UserNetworkStatusService constructor.
     */
    public function __construct()
    {
        $this->onlineUsers = [];
    }


    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function pushUserToOnline(UserInterface $user)
    {
        if (false === $this->isUserAlreadyOnline($user)) {
            $this->onlineUsers[] = $user->getId();
        }
    }

    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function detachUserFromOnline(UserInterface $user)
    {
        if (true === $this->isUserAlreadyOnline($user)) {
            $k = null;
            foreach ($this->onlineUsers as $key => $userId) {
                if ($userId === $user->getId()) {
                    $k = $key;
                    break;
                }
            }
            if (null !== $k) {
                unset($this->onlineUsers[$k]);
            }
        }
    }

    /**
     * @return array
     */
    public function getOnlineUsers()
    {
        return $this->onlineUsers;
    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    private function isUserAlreadyOnline(UserInterface $user):bool
    {
        return \in_array($user->getId(), $this->onlineUsers);
    }
}
