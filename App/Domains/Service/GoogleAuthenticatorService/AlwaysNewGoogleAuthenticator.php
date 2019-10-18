<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 16:36
 */

namespace App\Domains\Service\GoogleAuthenticatorService;


use Sonata\GoogleAuthenticator\GoogleAuthenticator;
use Sonata\GoogleAuthenticator\GoogleAuthenticatorInterface;

class AlwaysNewGoogleAuthenticator implements GoogleAuthenticatorInterface
{
    /**
     * @var int
     */
    private $passCodeLength;
    /**
     * @var int
     */
    private $secretLength;

    /**
     * AlwaysNewGoogleAuthenticator constructor.
     * @param int $passCodeLength
     * @param int $secretLength
     */
    public function __construct(int $passCodeLength = 6, int $secretLength = 10)
    {
        $this->passCodeLength = $passCodeLength;
        $this->secretLength = $secretLength;
    }

    /**
     * @param string $secret
     * @param string $code
     * @return bool
     */
    public function checkCode($secret, $code): bool
    {
        return $this->makeNewGA()->checkCode($secret, $code);
    }

    /**
     * @return GoogleAuthenticator
     */
    private function makeNewGA()
    {
        return new GoogleAuthenticator($this->passCodeLength, $this->secretLength);
    }

    /**
     * @param string $secret
     * @param \DateTimeInterface|null $time
     * @return string
     */
    public function getCode($secret, $time = null): string
    {
        return $this->makeNewGA()->getCode($secret, $time);
    }

    /**
     * @param string $user
     * @param string $hostname
     * @param string $secret
     * @return string
     * @deprecated avoid to use it
     */
    public function getUrl($user, $hostname, $secret): string
    {
        return $this->makeNewGA()->getUrl($user, $hostname, $secret);
    }

    /**
     * @return string
     */
    public function generateSecret(): string
    {
        return $this->makeNewGA()->generateSecret();
    }
}
