<?php


namespace actions\test;

use actions\ActionInterface;
use App\Domains\Service\Config\ConfigInterface;
use App\Repository\User\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Test
 * @package actions\test
 */
class Test implements ActionInterface
{
    private $config;

    public function __construct(
        ConfigInterface $config
    )
    {
        $this->config = $config;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('id');
        return [
            'data' => 'name',
            'key' => $this->config->get('app:db:key')
        ];
    }
}