<?php

namespace App\Domains\Responder\User;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface UserResponderInterface
 * @package App\Domains\Responder\User
 */
interface UserResponderInterface
{

    /**
     * @param UserInterface[] $users
     * @return array
     */
    public function respond(array $users);

}