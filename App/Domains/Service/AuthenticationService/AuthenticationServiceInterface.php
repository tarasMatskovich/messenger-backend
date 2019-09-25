<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 14:47
 */

namespace App\Domains\Service\AuthenticationService;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface AuthenticationServiceInterface
 * @package App\Domains\Service\AuthenticationService
 */
interface AuthenticationServiceInterface
{

    /**
     * @param UserInterface $user
     * @return string
     */
    public function createToken(UserInterface $user): string;

    /**
     * @param string $token
     * @return bool
     */
    public function checkToken(string $token): bool;

}
