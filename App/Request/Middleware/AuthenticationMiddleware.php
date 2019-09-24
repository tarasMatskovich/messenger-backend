<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 24.09.2019
 * Time: 16:35
 */

namespace App\Request\Middleware;

use App\Domains\Repository\User\UserRepositoryInterface;
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
     * AuthenticationMiddleware constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     * @throws NotAuthenticatedException
     */
    public function __invoke(ServerRequestInterface $request)
    {
        if (null === $request->getAttribute('userId')) {
            throw new NotAuthenticatedException('Данний користувач не має доступу до цього ресурсу');
        }
        return $request;
    }
}
