<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:19
 */

namespace App\Domains\Service\UserTOTPService;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface UserTOTPServiceInterface
 * @package App\Domains\Service\UserTOTPService
 */
interface UserTOTPServiceInterface
{
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
