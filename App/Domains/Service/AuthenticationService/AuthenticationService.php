<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 14:48
 */

namespace App\Domains\Service\AuthenticationService;

use App\Domains\Entities\User\UserInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\JWTService\JWTServiceInterface;

/**
 * Class AuthenticationService
 * @package App\Domains\Service\AuthenticationService
 */
class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var JWTServiceInterface
     */
    private $JWTService;

    /**
     * AuthenticationService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param JWTServiceInterface $JWTService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        JWTServiceInterface $JWTService
    )
    {
        $this->userRepository = $userRepository;
        $this->JWTService = $JWTService;
    }

    /**
     * @param UserInterface $user
     * @return string
     * @throws \Exception
     */
    public function createToken(UserInterface $user): string
    {
        $header = $this->makeHeader();
        $payload = $this->makePayload($user);
        return $this->JWTService->encode($header, $payload);
    }

    /**
     * @return array
     */
    private function makeHeader(): array
    {
        return [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
    }

    /**
     * @param UserInterface $user
     * @return array
     * @throws \Exception
     */
    private function makePayload(UserInterface $user): array
    {
        return [
            'iss' => 'auth.securemessenger.com.ua',
            'aud' => 'securemessenger.com.ua',
            'userId' => $user->getId(),
            'exp' => (new \DateTime('+3 days'))->format("Y-m-d")
        ];
    }

    /**
     * @param string $token
     * @return bool
     * @throws \Exception
     */
    public function checkToken(string $token): bool
    {
        if (!$this->isValidTokenStructure($token)) {
            return false;
        }
        $parts = $this->explodeToken($token);
        $payload = $parts[1];
        $payload = base64_decode($payload);
        $payload = json_decode($payload, true);
        if (!isset($payload['userId'])) {
            return false;
        }
        $user = $this->userRepository->find($payload['userId']);
        if (null === $user) {
            return false;
        }
        if (!isset($payload['exp'])) {
            return false;
        }
        if (false === $this->isValidTokenDate($payload['exp'])) {
            return false;
        }
        return true;
    }

    /**
     * @param $date
     * @return bool
     * @throws \Exception
     */
    private function isValidTokenDate($date): bool
    {
        return true;
        return (new \DateTime())->getTimestamp() >= (new \DateTime($date))->getTimestamp();
    }

    /**
     * @param string $token
     * @return bool
     */
    private function isValidTokenStructure(string $token): bool
    {
        $parts = $this->explodeToken($token);
        return count($parts) === 3;
    }

    /**
     * @param string $token
     * @return array
     */
    private function explodeToken(string $token): array
    {
        return explode('.', $token);
    }

}
