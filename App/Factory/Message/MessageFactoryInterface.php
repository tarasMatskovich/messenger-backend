<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 18:57
 */

namespace App\Factory\Message;

use App\Domains\Entities\Message\MessageInterface;
use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Entities\User\UserInterface;

/**
 * Interface MessageFactoryInterface
 * @package App\Factory\Message
 */
interface MessageFactoryInterface
{

    /**
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param string $content
     * @return MessageInterface
     */
    public function createForSend(SessionInterface $session, UserInterface $user, string $content): MessageInterface;

    /**
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param string $content
     * @return MessageInterface
     */
    public function createForReceiver(SessionInterface $session, UserInterface $user, string $content): MessageInterface;

}
