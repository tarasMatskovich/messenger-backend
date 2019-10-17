<?php


namespace App\Domains\Entities\Message;

/**
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domains\Repository\Message\MessageRepository")
 * @\Doctrine\ORM\Mapping\Table(name="messages")
 */
class Message implements MessageInterface
{

    /**
     * @\Doctrine\ORM\Mapping\Id()
     * @\Doctrine\ORM\Mapping\GeneratedValue()
     * @\Doctrine\ORM\Mapping\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="session_id", type="integer")
     */
    private $sessionId;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="content")
     */
    private $content;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="created_at")
     */
    private $createdAt;

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
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param $sessionId
     * @return void
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
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
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $content
     * @return void
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'sessionId' => $this->sessionId,
            'userId' => $this->userId,
            'type' => $this->type,
            'content' => $this->content,
            'createdAt' => $this->createdAt
        ];
    }
}
