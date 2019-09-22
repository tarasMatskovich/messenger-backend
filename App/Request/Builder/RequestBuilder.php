<?php


namespace App\Request\Builder;

use App\Request\ServerRequestMessage;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class RequestBuilder
 * @package App\Request\Builder
 */
class RequestBuilder implements RequestBuilderInterface
{

    /**
     * @return ServerRequestInterface
     */
    public function build(): ServerRequestInterface
    {
        return ServerRequestMessage::fromGlobals();
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $attributes
     * @return ServerRequestInterface
     */
    public function attachAttributesToRequest(ServerRequestInterface $request, array $attributes): ServerRequestInterface
    {
        foreach ($attributes as $name => $value) {
            $request->withAttribute($name, $value);
        }
        return $request;
    }
}