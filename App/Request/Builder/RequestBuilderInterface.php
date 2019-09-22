<?php


namespace App\Request\Builder;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface RequestBuilderInterface
 * @package App\Request\Builder
 */
interface RequestBuilderInterface
{

    /**
     * @return ServerRequestInterface
     */
    public function build(): ServerRequestInterface;

    /**
     * @param ServerRequestInterface $request
     * @param array $attributes
     * @return ServerRequestInterface
     */
    public function attachAttributesToRequest(ServerRequestInterface $request, array $attributes): ServerRequestInterface;

}