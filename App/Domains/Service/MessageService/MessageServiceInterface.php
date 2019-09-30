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

/**
 * Interface MessageServiceInterface
 * @package App\Domains\Service\MessageService
 */
interface MessageServiceInterface
{

    /**
     * @param SessionInterface $session
     * @param MessageInterface $message
     * @return void
     */
    public function publishMessage(SessionInterface $session, MessageInterface $message);

}
