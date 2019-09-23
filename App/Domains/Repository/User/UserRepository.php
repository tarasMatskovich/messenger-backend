<?php

namespace App\Domains\Repository\User;


use App\Domains\Entities\User\UserInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{

    /**
     * @param UserInterface $user
     * @return void
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(UserInterface $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
