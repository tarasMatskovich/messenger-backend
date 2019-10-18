<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 16:31
 */

namespace actions\user\auth\secondfactor\getsecret;


use actions\ActionInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSecretKey implements ActionInterface
{

    public function __invoke(ServerRequestInterface $request)
    {
        // TODO: Implement __invoke() method.
    }
}
