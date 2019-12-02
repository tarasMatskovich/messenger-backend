<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 19:20
 */

namespace App\Domains\Service\MessageService;

use App\Domains\Entities\Message\MessageInterface;
use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Responder\Message\MessageResponderInterface;
use App\Domains\Service\EventService\EventsEnum;
use App\Domains\Service\PublishService\Message\PublishMessage;
use App\Domains\Service\PublishService\PublishServiceInterface;
use Thruway\ClientSession;

/**
 * Class MessageService
 * @package App\Domains\Service\MessageService
 */
class MessageService implements MessageServiceInterface
{

    /**
     * @var MessageResponderInterface
     */
    private $messageResponder;

    /**
     * @var PublishServiceInterface
     */
    private $publishService;

    /**
     * MessageService constructor.
     * @param MessageResponderInterface $messageResponder
     * @param PublishServiceInterface $publishService
     */
    public function __construct(
        MessageResponderInterface $messageResponder,
        PublishServiceInterface $publishService
    )
    {
        $this->messageResponder = $messageResponder;
        $this->publishService = $publishService;
    }


    /**
     * @param SessionInterface $session
     * @param MessageInterface $receiverMessage
     * @param MessageInterface $senderMessage
     * @param $senderPublicKey
     * @return void
     */
    public function publishMessage(SessionInterface $session, MessageInterface $senderMessage, MessageInterface $receiverMessage, $senderPublicKey)
    {
        $receiverData = $this->messageResponder->respondMessage($receiverMessage);
        $senderData = $this->messageResponder->respondMessage($senderMessage);
        $topicName = 'user.session.' . $session->getId();
        $publishMessage = new PublishMessage(
            $topicName,
            EventsEnum::MESSAGE,
            [
                'receiver' => $receiverData,
                'sender' => $senderData
            ]
            );
        $this->publishService->publish($publishMessage);
    }
}
