<?php


namespace App\Domains\Entities\Message;

/**
 * Interface MessageInterface
 * @package App\Domains\Entities\Message
 */
interface MessageInterface
{

    /**
     * @return integer
     */
    public function getId();

    /**
     * @return integer
     */
    public function getSessionId();

    /**
     * @param $sessionId
     * @return void
     */
    public function setSessionId($sessionId);

    /**
     * @return integer
     */
    public function getUserId();

    /**
     * @param $userId
     * @return void
     */
    public function setUserId($userId);

    /**
     * @return integer
     */
    public function getType();

    /**
     * @param $type
     * @return void
     */
    public function setType($type);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param $content
     * @return void
     */
    public function setContent($content);

}