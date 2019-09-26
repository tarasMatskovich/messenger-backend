<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 12:51
 */

namespace App\Domains\Service\UserPassword;


use App\Domains\Entities\User\UserInterface;

/**
 * Class UserPasswordService
 * @package App\Domains\Service\UserPassword
 */
class UserPasswordService implements UserPasswordServiceInterface
{

    /**
     * @param string $password
     * @return string
     */
    public function generateHash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param UserInterface $user
     * @param string $password
     * @return bool
     */
    public function checkPassword(UserInterface $user, string $password): bool
    {
        return password_verify($password, $user->getPassword());
    }
}
