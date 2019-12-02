<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 28.11.2019
 * Time: 11:54
 */

namespace App\Domains\Service\PublishService;


use App\Domains\Service\PublishService\Message\PublishMessageInterface;
use Thruway\ClientSession;

/**
 * Class PublishService
 * @package App\Domains\Service\PublishService
 */
class PublishService implements PublishServiceInterface
{

    /**
     * @var ClientSession
     */
    private $clientSession;

    /**
     * PublishService constructor.
     * @param ClientSession $clientSession
     */
    public function __construct(ClientSession $clientSession)
    {
        $this->clientSession = $clientSession;
    }

    /**
     * @param PublishMessageInterface $message
     * @return void
     */
    public function publish(PublishMessageInterface $message)
    {
        $this->clientSession->publish($message->getTopicName(), [
            $message->getEventType(),
            json_encode($message->getArguments())
        ]);
    }
}
