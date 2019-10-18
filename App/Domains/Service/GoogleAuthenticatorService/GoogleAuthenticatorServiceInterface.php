<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:10
 */

namespace App\Domains\Service\GoogleAuthenticatorService;

/**
 * Interface GoogleAuthenticatorServiceInterface
 * @package App\Domains\Service\GoogleAuthenticatorService
 */
interface GoogleAuthenticatorServiceInterface
{

    /**
     * @param string $accountName
     * @param string $secret
     * @param string|null $issuer
     * @return string
     */
    public function getQrCodeUrl(string $accountName, string $secret, ?string $issuer = null): string;

    /**
     * @param string $code
     * @param string $secret
     * @return bool
     */
    public function verify(string $code, string $secret): bool;

}
