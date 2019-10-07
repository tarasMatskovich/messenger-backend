<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 07.10.2019
 * Time: 10:49
 */

namespace App\Domains\Responder\Message;

use App\Domains\Entities\Message\MessageInterface;

/**
 * Interface MessageResponderInterface
 * @package App\Domains\Responder\Message
 */
interface MessageResponderInterface
{

    /**
     * @param MessageInterface[] $messages
     * @return mixed
     */
    public function respondMessagesList(array $messages);

    /**
     * @param MessageInterface $message
     * @return array
     */
    public function respondMessage(MessageInterface $message);

}
