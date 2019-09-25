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
    public function makeUserFromSignUpRequest(ServerRequestInterface $serverRequest): UserInterface
    {
        $name = $serverRequest->getAttribute('name');
        $email = $serverRequest->getAttribute('email');
        $phone = $serverRequest->getAttribute('phone');
        $image = 'test.jpg';
        $password = $serverRequest->getAttribute('password');
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setImage($image);
        $user->setPassword($password);
        return $user;
    }
}
