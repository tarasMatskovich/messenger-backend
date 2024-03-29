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

    /**
     * @param UserInterface $user
     * @param string $password
     * @return bool
     */
    public function verifyUser(UserInterface $user, string $password): bool;

    /**
     * @param UserInterface $user
     * @return string
     */
    public function getQrCodeUrl(UserInterface $user): string;

    /**
     * @param UserInterface $user
     * @param string $code
     * @return bool
     */
    public function checkCode(UserInterface $user, string $code): bool;

}
