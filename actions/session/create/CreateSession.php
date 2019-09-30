<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 18:49
 */

namespace actions\session\create;


use actions\ActionInterface;
use App\Domains\Entities\Session\Session;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CreateSession
 * @package actions\session\create
 */
class CreateSession implements ActionInterface
{

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * CreateSession constructor.
     * @param SessionRepositoryInterface $sessionRepository
     */
    public function __construct(SessionRepositoryInterface $sessionRepository)
    {
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        $receivedUserId = $request->getAttribute('receivedUserId');
        $session = new Session();
        $session->setUser1Id($userId);
        $session->setUser2Id($receivedUserId);
        $this->sessionRepository->save($session);
        return [
            'session' => $session->toArray()
        ];
    }
}
