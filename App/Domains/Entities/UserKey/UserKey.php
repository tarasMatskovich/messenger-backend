<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 31.10.2019
 * Time: 15:05
 */

namespace App\Domains\Entities\UserKey;

/**
 * Class UserKey
 * @package App\Domains\Entities\UserKey
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domains\Repository\UserKey\UserKeyRepository")
 * @\Doctrine\ORM\Mapping\Table(name="users_keys")
 */
class UserKey implements UserKeyInterface
{

    /**
     * @\Doctrine\ORM\Mapping\Id()
     * @\Doctrine\ORM\Mapping\GeneratedValue()
     * @\Doctrine\ORM\Mapping\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="user_id")
     */
    private $userId;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="public_key")
     */
    private $key;

    /**
     * UserKey constructor.
     * @param null $userId
     * @param null $key
     */
    public function __construct($userId = null, $key = null)
    {
        $this->userId = $userId;
        $this->key = $key;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $userId
     * @return void
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param $key
     * @return void
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'userId' => $this->getUserId(),
            'key' => $this->getKey()
        ];
    }
}
