<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 07.10.2019
 * Time: 10:42
 */

namespace actions\message\getlist;


use actions\ActionInterface;
use App\Domains\Repository\Message\MessageRepositoryInterface;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Responder\Message\MessageResponderInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetMessagesList
 * @package actions\message\getlist
 */
class GetMessagesList implements ActionInterface
{

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * @var MessageResponderInterface
     */
    private $messageResponder;

    /**
     * GetMessagesList constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param SessionRepositoryInterface $sessionRepository
     * @param MessageResponderInterface $messageResponder
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        SessionRepositoryInterface $sessionRepository,
        MessageResponderInterface $messageResponder
    )
    {
        $this->messageRepository = $messageRepository;
        $this->sessionRepository = $sessionRepository;
        $this->messageResponder = $messageResponder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $sessionId = $request->getAttribute('sessionId');
        if (null !== $sessionId) {
            $session = $this->sessionRepository->find($sessionId);
            if (null !== $session) {
                $messages = $this->messageRepository->findBy(['sessionId' => $session->getId()]);
                return [
                    'sessionId' => $session->getId(),
                    'messages' => $this->messageResponder->respondMessagesList($messages)
                ];
            }
        }
        throw new \Exception('Невідомий ідентифікатор сесії');
    }
}
