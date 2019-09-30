<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 19:12
 */

namespace App\Factory\Message;


use App\Domains\Entities\Message\Message;
use App\Domains\Entities\Message\MessageInterface;
use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Entities\User\UserInterface;

/**
 * Class MessageFactory
 * @package App\Factory\Message
 */
class MessageFactory implements MessageFactoryInterface
{

    /**
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param string $content
     * @return MessageInterface
     */
    public function createForSend(SessionInterface $session, UserInterface $user, string $content): MessageInterface
    {
        $message = new Message();
        $message->setSessionId($session->getId());
        $message->setUserId($user->getId());
        $message->setType(0);
        $message->setContent($content);
        return $message;
    }

    /**
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param string $content
     * @return MessageInterface
     */
    public function createForReceiver(SessionInterface $session, UserInterface $user, string $content): MessageInterface
    {
        $message = new Message();
        $message->setSessionId($session->getId());
        $message->setUserId($user->getId());
        $message->setType(1);
        $message->setContent($content);
        return $message;
    }
}
