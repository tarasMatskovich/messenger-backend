<?php

namespace actions\auth;


use actions\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;

class CheckAuth implements ActionInterface
{

    public function __invoke(ServerRequestInterface $request)
    {
        return [];
    }
}