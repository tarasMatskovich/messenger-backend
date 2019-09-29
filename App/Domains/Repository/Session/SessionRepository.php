<?php


namespace App\Domains\Repository\Session;

use App\Domains\Entities\Session\SessionInterface;
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

}