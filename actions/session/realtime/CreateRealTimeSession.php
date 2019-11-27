<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.11.2019
 * Time: 15:16
 */

namespace actions\session\realtime;

use actions\ActionInterface;
use App\Domains\Entities\Session\Session;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CreateRealTimeSession
 * @package actions\session\realtime
 */
class CreateRealTimeSession implements ActionInterface
{

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * CreateRealTimeSession constructor.
     * @param SessionRepositoryInterface $sessionRepository
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        UserRepositoryInterface $userRepository
    )
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $user1Id = $request->getAttribute('user1Id');
        $user2Id = $request->getAttribute('user2Id');
        if (null !== $user1Id && null !== $user2Id) {
            $user1 = $this->userRepository->find($user1Id);
            $user2 = $this->userRepository->find($user2Id);
            if (null !== $user1 && null != $user2) {
                $session = new Session();
                $session->setUser1Id($user1->getId());
                $session->setUser2Id($user2->getId());

            }
        }
    }
}
