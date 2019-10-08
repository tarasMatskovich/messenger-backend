<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:01
 */

namespace App\EventListener;

/**
 * Class EventListener
 * @package App\EventListener
 */
class EventListener implements EventListenerInterface
{

    /**
     * @var
     */
    private $channels;

    /**
     * EventListener constructor.
     * @param array $channels
     */
    public function __construct(array $channels)
    {
        $this->channels = $channels;
    }

    /**
     * @return array
     */
    public function getChannels()
    {
        return $this->channels;
    }
}
