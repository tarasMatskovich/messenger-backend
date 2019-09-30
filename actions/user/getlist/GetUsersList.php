<?php

namespace actions\user\getlist;

use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Responder\User\UserResponder;
use Psr\Http\Message\ServerRequestInterface;
use Thruway\ClientSession;

/**
 * Class GetUsersList
 * @package actions\user\getlist
 */
class GetUsersList implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserResponder
     */
    private $userResponder;

    /**
     * GetUsersList constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserResponder $userResponder
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserResponder $userResponder
    )
    {
        $this->userRepository = $userRepository;
        $this->userResponder = $userResponder;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $users = $this->userRepository->findAll();
        return [
            'users' => $this->userResponder->respond($users)
        ];
    }
}
