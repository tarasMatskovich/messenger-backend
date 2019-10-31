<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 14:58
 */

namespace actions\user\publickey\set;


use actions\ActionInterface;
use App\Domains\Entities\UserKey\UserKey;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Repository\UserKey\UserKeyRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SetUserPublicKey
 * @package actions\user\publickey\set
 */
class SetUserPublicKey implements ActionInterface
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
     * SetUserPublicKey constructor.
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
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        $publicKey = $request->getAttribute('publicKey');
        if (null !== $userId && null !== $publicKey) {
            $user = $this->userRepository->find($userId);
            if (null !== $user) {
                $userKey = $this->userKeyRepository->findByUser($user);
                if (null === $userKey) {
                    $userKey = new UserKey($user->getId(), $publicKey);
                } else {
                    $userPublicKey = $userKey->getKey();
                    if ((string)$userPublicKey !== (string)$publicKey) {
                        $userKey->setKey($publicKey);
                    }
                }
                $this->userKeyRepository->save($userKey);
            }
        }
        return [];
    }
}
