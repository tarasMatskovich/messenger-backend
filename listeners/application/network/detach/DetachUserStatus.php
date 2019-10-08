<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 12:13
 */

namespace listeners\application\network\detach;


use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\UserNetworkStatusService\UserNetworkStatusServiceInterface;
use listeners\ListenerInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class DetachUserStatus
 * @package listeners\application\network\detach
 */
class DetachUserStatus implements ListenerInterface
{

    /**
     * @var UserNetworkStatusServiceInterface
     */
    private $userNetworkStatusService;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * DetachUserStatus constructor.
     * @param UserNetworkStatusServiceInterface $userNetworkStatusService
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserNetworkStatusServiceInterface $userNetworkStatusService,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userNetworkStatusService = $userNetworkStatusService;
        $this->userRepository = $userRepository;
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
                $this->userNetworkStatusService->detachUserFromOnline($user);
            }
        }
        return [];
    }
}
