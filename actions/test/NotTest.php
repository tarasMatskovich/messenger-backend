<?php


namespace actions\test;


use actions\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotTest implements ActionInterface
{

    public function __invoke(ServerRequestInterface $request)
    {
        return [
            'data' => '123'
        ];
    }
}