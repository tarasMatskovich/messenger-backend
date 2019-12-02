<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 28.11.2019
 * Time: 11:55
 */

namespace App\Domains\Service\PublishService\Message;

/**
 * Class PublishMessage
 * @package App\Domains\Service\PublishService\Message
 */
class PublishMessage implements PublishMessageInterface
{

    /**
     * @var string
     */
    private $topicName;

    /**
     * @var string
     */
    private $eventType;

    /**
     * @var array
     */
    private $arguments;

    /**
     * PublishMessage constructor.
     * @param string $topicName
     * @param string $eventType
     * @param array $arguments
     */
    public function __construct(string $topicName, string $eventType, array $arguments)
    {
        $this->topicName = $topicName;
        $this->eventType = $eventType;
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getTopicName()
    {
        return $this->topicName;
    }

    /**
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}
