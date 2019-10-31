<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 15:11
 */

namespace App\Domains\Repository\UserKey;


use App\Domains\Entities\User\UserInterface;
use App\Domains\Entities\UserKey\UserKeyInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserKeyRepository
 * @package App\Domains\Repository\UserKey
 */
class UserKeyRepository extends EntityRepository implements UserKeyRepositoryInterface
{

    /**
     * @param UserKeyInterface $userKey
     * @return void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserKeyInterface $userKey)
    {
        $this->_em->persist($userKey);
        $this->_em->flush();
    }

    /**
     * @param UserInterface $user
     * @return UserKeyInterface|null|object
     */
    public function findByUser(UserInterface $user)
    {
        return $this->findOneBy(['userId' => $user->getId()]);
    }
}
