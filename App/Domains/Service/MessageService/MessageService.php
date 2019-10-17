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
use Thruway\ClientSession;

/**
 * Class MessageService
 * @package App\Domains\Service\MessageService
 */
class MessageService implements MessageServiceInterface
{

    /**
     * @var ClientSession
     */
    private $clientSession;

    /**
     * @var MessageResponderInterface
     */
    private $messageResponder;

    /**
     * MessageService constructor.
     * @param ClientSession $clientSession
     * @param MessageResponderInterface $messageResponder
     */
    public function __construct(
        ClientSession $clientSession,
        MessageResponderInterface $messageResponder
    )
    {
        $this->clientSession = $clientSession;
        $this->messageResponder = $messageResponder;
    }


    /**
     * @param SessionInterface $session
     * @param MessageInterface $message
     * @return void
     */
    public function publishMessage(SessionInterface $session, MessageInterface $message)
    {
        $this->clientSession->publish('user.session.' . $session->getId(), [
            EventsEnum::MESSAGE,
            json_encode($this->messageResponder->respondMessage($message))
        ]);
    }
}