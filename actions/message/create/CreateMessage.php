<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 18:55
 */

namespace actions\message\create;


use actions\ActionInterface;
use App\Domains\Repository\Message\MessageRepositoryInterface;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\MessageService\MessageServiceInterface;
use App\Factory\Message\MessageFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CreateMessage
 * @package actions\message\create
 */
class CreateMessage implements ActionInterface
{

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * @var MessageFactoryInterface
     */
    private $messageFactory;

    /**
     * @var MessageServiceInterface
     */
    private $messageService;

    /**
     * CreateMessage constructor.
     * @param MessageRepositoryInterface $messageRepository
     * @param UserRepositoryInterface $userRepository
     * @param SessionRepositoryInterface $sessionRepository
     * @param MessageFactoryInterface $messageFactory
     * @param MessageServiceInterface $messageService
     */
    public function __construct(
        MessageRepositoryInterface $messageRepository,
        UserRepositoryInterface $userRepository,
        SessionRepositoryInterface $sessionRepository,
        MessageFactoryInterface $messageFactory,
        MessageServiceInterface $messageService
    )
    {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
        $this->sessionRepository = $sessionRepository;
        $this->messageFactory = $messageFactory;
        $this->messageService = $messageService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        $receivedUserId = $request->getAttribute('receivedUserId');
        $sessionId = $request->getAttribute('sessionId');
        $senderPublicKey = $request->getAttribute('publicKey');
        $content = $request->getAttribute('content', '');
        $senderContent = $request->getAttribute('senderContent', '');
        if (null === $userId || null === $receivedUserId || null === $sessionId) {
            throw new \Exception('Неправильні аргументи для створення повідомлення', 500);
        }
        $user = $this->userRepository->find($userId);
        $receiver = $this->userRepository->find($receivedUserId);
        $session = $this->sessionRepository->find($sessionId);
        if (null === $user || null === $receiver || null === $session) {
            throw new \Exception('Неправильні аргументи для створення повідомлення', 500);
        }
        $senderMessage = $this->messageFactory->createForSend($session, $user, $senderContent, $user);
        $receiverMessage = $this->messageFactory->createForReceiver($session, $receiver, $content, $user);
        $this->messageRepository->save($senderMessage);
        $this->messageRepository->save($receiverMessage);
        $this->messageService->publishMessage($session, $senderMessage, $receiverMessage, $senderPublicKey);
        return [];
    }
}
