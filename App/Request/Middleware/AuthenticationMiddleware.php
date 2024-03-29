<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 24.09.2019
 * Time: 16:35
 */

namespace App\Request\Middleware;

use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Request\Exception\NotAuthenticatedException;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthenticationMiddleware
 * @package App\Request\Middleware
 */
class AuthenticationMiddleware implements MiddlewareInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * AuthenticationMiddleware constructor.
     * @param UserRepositoryInterface $userRepository
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        AuthenticationServiceInterface $authenticationService
    )
    {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     * @throws NotAuthenticatedException
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $token = $request->getAttribute('token');
        if (null === $token) {
            throw new NotAuthenticatedException('У вас немає прав на даний ресурс');
        }
        if (false === $this->authenticationService->checkToken($token)) {
            throw new NotAuthenticatedException('Ваш токен аутентифікації є не дійсним. Будь ласка спробуйте ввійти в систему ще раз');
        }
        return $request;
    }
}
