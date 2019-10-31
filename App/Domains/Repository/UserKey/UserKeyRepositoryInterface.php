<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 15:10
 */

namespace App\Domains\Repository\UserKey;

use App\Domains\Entities\User\UserInterface;
use App\Domains\Entities\UserKey\UserKeyInterface;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface UserKeyRepositoryInterface
 * @package App\Domains\Repository\UserKey
 */
interface UserKeyRepositoryInterface extends ObjectRepository
{

    /**
     * @param $id
     * @return UserKeyInterface|null
     */
    public function find($id);

    /**
     * @param array $criteria
     * @return UserKeyInterface|null
     */
    public function findOneBy(array $criteria);

    /**
     * @param UserKeyInterface $userKey
     * @return void
     */
    public function save(UserKeyInterface $userKey);

    /**
     * @param UserInterface $user
     * @return UserKeyInterface|null
     */
    public function findByUser(UserInterface $user);

}
