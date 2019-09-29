<?php


namespace App\Domains\Entities\Session;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domains\Repository\Session\SessionRepository")
 * @\Doctrine\ORM\Mapping\Table(name="sessions")
 */
class Session implements SessionInterface
{

    /**
     * @\Doctrine\ORM\Mapping\Id()
     * @\Doctrine\ORM\Mapping\GeneratedValue()
     * @\Doctrine\ORM\Mapping\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="user1_id")
     */
    private $user1Id;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="user2_id")
     */
    private $user2Id;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return integer
     */
    public function getUser1Id()
    {
        return $this->user1Id;
    }

    /**
     * @param $user1Id
     * @return void
     */
    public function setUser1Id($user1Id)
    {
        $this->user1Id = $user1Id;
    }

    /**
     * @return integer
     */
    public function getUser2Id()
    {
        return $this->user2Id;
    }

    /**
     * @param $user2Id
     * @return void
     */
    public function setUser2Id($user2Id)
    {
        $this->user2Id = $user2Id;
    }
}