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
     * @param UserInterface $createdBY
     * @return MessageInterface
     */
    public function createForSend(SessionInterface $session, UserInterface $user, string $content, UserInterface $createdBY): MessageInterface;

    /**
     * @param SessionInterface $session
     * @param UserInterface $user
     * @param string $content
     * @param UserInterface $createdBy
     * @return MessageInterface
     */
    public function createForReceiver(SessionInterface $session, UserInterface $user, string $content, UserInterface $createdBy): MessageInterface;

}
