<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:01
 */

namespace App\EventListener;

/**
 * Interface EventListenerInterface
 * @package App\EventListener
 */
interface EventListenerInterface
{

    /**
     * @return array
     */
    public function getChannels();

}
