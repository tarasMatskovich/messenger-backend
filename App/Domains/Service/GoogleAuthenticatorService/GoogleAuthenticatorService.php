<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 11:11
 */

namespace App\Domains\Service\GoogleAuthenticatorService;


use Sonata\GoogleAuthenticator\GoogleAuthenticatorInterface;
use Sonata\GoogleAuthenticator\GoogleQrUrl;

/**
 * Class GoogleAuthenticatorService
 * @package App\Domains\Service\GoogleAuthenticatorService
 */
class GoogleAuthenticatorService implements GoogleAuthenticatorServiceInterface
{

    /**
     * @var GoogleAuthenticatorInterface
     */
    private $gaService;

    /**
     * GoogleAuthenticatorService constructor.
     * @param GoogleAuthenticatorInterface $gaService
     */
    public function __construct(GoogleAuthenticatorInterface $gaService)
    {
        $this->gaService = $gaService;
    }

    /**
     * @param string $accountName
     * @param string $secret
     * @param string|null $issuer
     * @return string
     */
    public function getQrCodeUrl(string $accountName, string $secret, ?string $issuer = null): string
    {
        return GoogleQrUrl::generate($accountName, $secret, $issuer);
    }

    /**
     * @param string $code
     * @param string $secret
     * @return bool
     */
    public function verify(string $code, string $secret): bool
    {
        return $this->gaService->checkCode($secret, $code);
    }
}
