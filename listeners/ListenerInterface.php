<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:16
 */

namespace listeners;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface ListenerInterface
 * @package listeners
 */
interface ListenerInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request);

}
