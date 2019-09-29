<?php


namespace App\Domains\Repository\Session;

use App\Domains\Entities\Session\SessionInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface SessionRepositoryInterface
 * @package App\Domains\Repository\Session
 */
interface SessionRepositoryInterface extends ObjectRepository
{

    /**
     * @param $id
     * @return SessionInterface|null
     */
    public function find($id);

    /**
     * @param array $criteria
     * @return SessionInterface|null
     */
    public function findOneBy(array $criteria);

    /**
     * @param SessionInterface $session
     * @return void
     */
    public function save(SessionInterface $session);

}