<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 15:04
 */

namespace App\Domains\Entities\UserKey;

/**
 * Interface UserKeyInterface
 * @package App\Domains\Entities\UserKey
 */
interface UserKeyInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getUserId();

    /**
     * @param $userId
     * @return void
     */
    public function setUserId($userId);

    /**
     * @return string
     */
    public function getKey();

    /**
     * @param $key
     * @return void
     */
    public function setKey($key);

    /**
     * @return array
     */
    public function toArray();

}
