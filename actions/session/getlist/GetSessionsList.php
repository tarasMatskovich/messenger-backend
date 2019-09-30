<?php


namespace actions\session\getlist;


use actions\ActionInterface;
use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Entities\User\UserInterface;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Responder\Session\SessionResponderInterface;
use App\Domains\Responder\User\UserResponderInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetSessionsList
 * @package actions\session\getlist
 */
class GetSessionsList implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * @var SessionResponderInterface
     */
    private $sessionResponder;

    /**
     * @var UserResponderInterface
     */
    private $userResponder;

    /**
     * GetSessionsList constructor.
     * @param UserRepositoryInterface $userRepository
     * @param SessionRepositoryInterface $sessionRepository
     * @param SessionResponderInterface $sessionResponder
     * @param UserResponderInterface $userResponder
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        SessionRepositoryInterface $sessionRepository,
        SessionResponderInterface $sessionResponder,
        UserResponderInterface $userResponder
    )
    {
        $this->userRepository = $userRepository;
        $this->sessionRepository = $sessionRepository;
        $this->sessionResponder = $sessionResponder;
        $this->userResponder = $userResponder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        if (null !== $userId) {
            $user = $this->userRepository->find($userId);
            if (null !== $user) {
                $sessions = $this->sessionRepository->findUserSessions($user);
                $users = $this->getSingleUsers($sessions);
                $sessions = $this->sessionResponder->respondExtendedList($sessions, $user);
                $users = $this->userResponder->respond($users);
                $result = array_merge($sessions, $users);
                return [
                    'sessions' => $result
                ];
            }
        }
        return [
            'sessions' => []
        ];
    }

    /**
     * @param SessionInterface[] $sessions
     * @return UserInterface[]
     */
    private function getSingleUsers(array $sessions)
    {
        $existingUsersIds = [];
        foreach ($sessions as $session) {
            $existingUsersIds[] = (int)$session->getUser1Id();
            $existingUsersIds[] = (int)$session->getUser2Id();
        }
        $users = [];
        if (empty($existingUsersIds)) {
            $users = $this->userRepository->findAll();
        } else {
            $users = $this->userRepository->findExceptIds($existingUsersIds);
        }
        return $users;
    }
}
