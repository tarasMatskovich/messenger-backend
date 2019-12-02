<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 28.11.2019
 * Time: 11:54
 */

namespace App\Domains\Service\PublishService\Message;

/**
 * Interface PublishMessageInterface
 * @package App\Domains\Service\PublishService\Message
 */
interface PublishMessageInterface
{

    /**
     * @return string
     */
    public function getTopicName();

    /**
     * @return string
     */
    public function getEventType();

    /**
     * @return array
     */
    public function getArguments();

}
