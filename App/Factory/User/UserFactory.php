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
use App\Domains\Service\UserPassword\UserPasswordServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserFactory
 * @package App\Factory\User
 */
class UserFactory implements UserFactoryInterface
{

    /**
     * @var UserPasswordServiceInterface
     */
    private $userPasswordService;

    /**
     * UserFactory constructor.
     * @param UserPasswordServiceInterface $userPasswordService
     */
    public function __construct(UserPasswordServiceInterface $userPasswordService)
    {
        $this->userPasswordService = $userPasswordService;
    }

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
        $password = $this->userPasswordService->generateHash($serverRequest->getAttribute('password'));
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setImage($image);
        $user->setPassword($password);
        return $user;
    }
}
