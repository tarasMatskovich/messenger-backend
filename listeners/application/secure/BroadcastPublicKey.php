<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 21.10.2019
 * Time: 18:49
 */

namespace listeners\application\secure;


use listeners\ListenerInterface;
use Psr\Http\Message\ServerRequestInterface;

class BroadcastPublicKey implements ListenerInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        // TODO: Implement __invoke() method.
    }
}
