<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 28.11.2019
 * Time: 11:54
 */

namespace App\Domains\Service\PublishService;

use App\Domains\Service\PublishService\Message\PublishMessageInterface;

/**
 * Interface PublishServiceInterface
 * @package App\Domains\Service\PublishService
 */
interface PublishServiceInterface
{

    /**
     * @param PublishMessageInterface $message
     * @return void
     */
    public function publish(PublishMessageInterface $message);

}
