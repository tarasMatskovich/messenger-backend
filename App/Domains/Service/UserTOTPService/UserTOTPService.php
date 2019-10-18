<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:19
 */

namespace App\Domains\Service\UserTOTPService;

use App\Domains\Entities\User\UserInterface;
use App\Domains\Service\Base32EncoderService\Base32Interface;
use App\Domains\Service\GoogleAuthenticatorService\GoogleAuthenticatorServiceInterface;

/**
 * Class UserTOTPService
 * @package App\Domains\Service\UserTOTPService
 */
class UserTOTPService implements UserTOTPServiceInterface
{

    /**
     * @var GoogleAuthenticatorServiceInterface
     */
    private $googleAuthenticatorService;

    /**
     * @var Base32Interface
     */
    private $base32;

    /**
     * @var string
     */
    private $salt;

    /**
     * @var string|null
     */
    private $issuer;

    /**
     * UserTOTPService constructor.
     * @param GoogleAuthenticatorServiceInterface $googleAuthenticatorService
     * @param Base32Interface $base32
     * @param string $salt
     * @param string|null $issuer
     */
    public function __construct(
        GoogleAuthenticatorServiceInterface $googleAuthenticatorService,
        Base32Interface $base32,
        string $salt,
        ?string $issuer = null
    )
    {
        $this->googleAuthenticatorService = $googleAuthenticatorService;
        $this->base32 = $base32;
        $this->salt = $salt;
        $this->issuer = $issuer;
    }


    /**
     * @param UserInterface $user
     * @return string
     */
    public function getQrCodeUrl(UserInterface $user): string
    {
        return $this->googleAuthenticatorService->getQrCodeUrl($this->getAccountName($user), $this->generateSecret($user), $this->issuer);
    }

    /**
     * @param UserInterface $user
     * @return string
     */
    private function getAccountName(UserInterface $user)
    {
        return $user->getEmail();
    }

    /**
     * @param UserInterface $user
     * @return string
     */
    private function generateSecret(UserInterface $user)
    {
        $salted = ($user->getId() ?: '') . $this->salt;
        $n = (strlen($salted)) / 5;
        $substring = substr($salted, 0, (int)$n * 5);
        return $this->base32->encode($substring);
    }

    /**
     * @param UserInterface $user
     * @param string $code
     * @return bool
     */
    public function checkCode(UserInterface $user, string $code): bool
    {
        return $this->googleAuthenticatorService->verify($code, $this->generateSecret($user));
    }
}
