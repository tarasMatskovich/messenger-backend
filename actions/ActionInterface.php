<?php

namespace actions;

use Psr\Http\Message\ServerRequestInterface;

interface ActionInterface
{

    public function __invoke(ServerRequestInterface $request);

}