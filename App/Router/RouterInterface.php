<?php


namespace App\Router;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RouterInterface
 * @package App\router
 */
interface RouterInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function run(ServerRequestInterface $request);

    /**
     * @return array
     */
    public function getRoutes();

}