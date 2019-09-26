<?php


namespace actions\test;

use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\Config\ConfigInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Test
 * @package actions\test
 */
class Test implements ActionInterface
{
    private $config;

    private $userRepository;

    public function __construct(
        ConfigInterface $config,
        UserRepositoryInterface $userRepository
    )
    {
        $this->config = $config;
        $this->userRepository = $userRepository;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('userId');
        $user = $this->userRepository->find($id);
        return [
            'data' => $user->getName(),
            'key' => $this->config->get('app:db:key')
        ];
    }
}
