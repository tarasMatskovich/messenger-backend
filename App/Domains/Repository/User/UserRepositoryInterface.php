<?php


namespace App\Domains\Repository\User;

use App\Domains\Entities\User\UserInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface UserRepositoryInterface
 * @package App\Domains\Repository\User
 */
interface UserRepositoryInterface extends ObjectRepository
{

    /**
     * @param $id
     * @return UserInterface|null
     */
    public function find($id);

    /**
     * @param array $criteria
     * @return UserInterface|null
     */
    public function findOneBy(array $criteria);

    /**
     * @param UserInterface $user
     * @return void
     */
    public function save(UserInterface $user);

}
