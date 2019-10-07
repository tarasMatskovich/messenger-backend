<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 18:44
 */

namespace actions\session\get;


use actions\ActionInterface;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetSession
 * @package actions\session\get
 */
class GetSession implements ActionInterface
{

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * GetSession constructor.
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(
        SessionRepositoryInterface $sessionRepository
    )
    {
        $this->sessionRepository = $sessionRepository;
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $sessionId = $request->getAttribute('sessionId');
        $session = $this->sessionRepository->find($sessionId);
        if (null === $session) {
            return [
                'session' => null
            ];
        }
        return [
            'session' => $session->toArray()
        ];
    }
}
