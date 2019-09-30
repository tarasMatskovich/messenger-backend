<?php


namespace App\Domains\Entities\Session;

/**
 * Interface SessionInterface
 * @package App\Domains\Entities\Session
 */
interface SessionInterface
{

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return integer
     */
    public function getUser1Id();

    /**
     * @param $user1Id
     * @return void
     */
    public function setUser1Id($user1Id);

    /**
     * @return integer
     */
    public function getUser2Id();

    /**
     * @param $user2Id
     * @return void
     */
    public function setUser2Id($user2Id);

    /**
     * @return array
     */
    public function toArray();

}
