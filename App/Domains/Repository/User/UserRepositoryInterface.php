<?php


namespace App\Domains\Repository\User;

use App\Domains\Entities\User\UserInterface;

/**
 * Interface UserRepositoryInterface
 * @package App\Domains\Repository\User
 */
interface UserRepositoryInterface
{

    /**
     * @param $id
     * @return UserInterface|null
     */
    public function find($id);

}