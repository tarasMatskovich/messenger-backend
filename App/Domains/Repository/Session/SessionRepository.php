<?php


namespace App\Domains\Repository\Session;

use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Entities\User\UserInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class SessionRepository
 * @package App\Domains\Repository\Session
 */
class SessionRepository extends EntityRepository implements SessionRepositoryInterface
{

    /**
     * @param SessionInterface $session
     * @return void
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(SessionInterface $session)
    {
        $this->_em->persist($session);
        $this->_em->flush();
    }

    /**
     * @param UserInterface $user
     * @return SessionInterface[]
     */
    public function findUserSessions(UserInterface $user)
    {
        return $this->createQueryBuilder('session')
            ->andWhere('session.user1Id = :value OR session.user2Id = :value')
            ->setParameter('value', $user->getId())
            ->getQuery()
            ->execute();
    }
}
