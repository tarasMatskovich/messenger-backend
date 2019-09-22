<?php

namespace App\Domains\Repository\User;



use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class UserRepository extends EntityRepository implements UserRepositoryInterface
{

}