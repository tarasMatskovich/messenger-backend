<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 14:58
 */

namespace actions\user\publickey\get;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Repository\UserKey\UserKeyRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetUserPublicKey
 * @package actions\user\publickey\get
 */
class GetUserPublicKey implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserKeyRepositoryInterface
     */
    private $userKeyRepository;

    /**
     * GetUserPublicKey constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserKeyRepositoryInterface $userKeyRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserKeyRepositoryInterface $userKeyRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userKeyRepository = $userKeyRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('accountId');
        if (null !== $userId) {
            $user = $this->userRepository->find($userId);
            if (null !== $user) {
                $userKey = $this->userKeyRepository->findByUser($user);
                if (null !== $userKey) {
                    return [
                        'userKey' => $userKey->toArray()
                    ];
                }
                return [
                    'userKey' => null
                ];
            }
        }
        throw new \Exception('Немає такого користувача', 404);
    }
}
