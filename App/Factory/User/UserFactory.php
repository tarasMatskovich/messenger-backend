<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 18:27
 */

namespace App\Factory\User;


use App\Domains\Entities\User\User;
use App\Domains\Entities\User\UserInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserFactory
 * @package App\Factory\User
 */
class UserFactory implements UserFactoryInterface
{

    /**
     * @param ServerRequestInterface $serverRequest
     * @return UserInterface
     */
    public function makeUserFromRequest(ServerRequestInterface $serverRequest): UserInterface
    {
        $name = $serverRequest->getAttribute('name');
        $user = new User();
        $user->setName($name);
        return $user;
    }
}
