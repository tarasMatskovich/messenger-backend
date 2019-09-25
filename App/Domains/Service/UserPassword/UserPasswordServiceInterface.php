<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 12:50
 */

namespace App\Domains\Service\UserPassword;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface UserPassportServiceInterface
 * @package App\Domains\Service\UserPassword
 */
interface UserPasswordServiceInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function generateHash(string $password): string;

    /**
     * @param UserInterface $user
     * @param string $password
     * @return bool
     */
    public function checkPassword(UserInterface $user, string $password): bool;

}
