<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.11.2019
 * Time: 15:16
 */

namespace actions\session\realtime;

use actions\ActionInterface;
use App\Domains\Entities\Session\Session;
use App\Domains\Repository\Session\SessionRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Repository\UserKey\UserKeyRepositoryInterface;
use App\Domains\Service\EventService\EventsEnum;
use App\Domains\Service\PublishService\Message\PublishMessage;
use App\Domains\Service\PublishService\PublishServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CreateRealTimeSession
 * @package actions\session\realtime
 */
class CreateRealTimeSession implements ActionInterface
{

    /**
     * @var SessionRepositoryInterface
     */
    private $sessionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserKeyRepositoryInterface
     */
    private $userKeyRepository;

    /**
     * @var PublishServiceInterface
     */
    private $publishService;

    /**
     * CreateRealTimeSession constructor.
     * @param SessionRepositoryInterface $sessionRepository
     * @param UserRepositoryInterface $userRepository
     * @param UserKeyRepositoryInterface $userKeyRepository
     * @param PublishServiceInterface $publishService
     */
    public function __construct(
        SessionRepositoryInterface $sessionRepository,
        UserRepositoryInterface $userRepository,
        UserKeyRepositoryInterface $userKeyRepository,
        PublishServiceInterface $publishService
    )
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
        $this->userKeyRepository = $userKeyRepository;
        $this->publishService = $publishService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        $user1Id = $request->getAttribute('user1Id');
        $user2Id = $request->getAttribute('user2Id');
        if (null !== $user1Id && null !== $user2Id) {
            $user1 = $this->userRepository->find($user1Id);
            $user2 = $this->userRepository->find($user2Id);
            if (null !== $user1 && null != $user2) {
                $session = new Session();
                $session->setUser1Id($user1->getId());
                $session->setUser2Id($user2->getId());
                $this->sessionRepository->save($session);
                $receiverId = null;
                if ((int)$userId === (int)$user1Id) {
                    $receiverId = $user2Id;
                } else {
                    $receiverId = $user1Id;
                }
                $receiver = $this->userRepository->find($receiverId);
                $sender = $this->userRepository->find($userId);
                if (null !== $receiver && null !== $sender) {
                    $receiverPublicKey = $this->userKeyRepository->findByUser($receiver);
                    $senderPublicKey = $this->userKeyRepository->findByUser($sender);
                    $topicName = 'user.session.created.' . $receiver->getId();
                    $message = new PublishMessage(
                        $topicName,
                        EventsEnum::CREATED_SESSION,
                        [
                            'senderPublicKey' => $senderPublicKey->getKey(),
                            'session' => $session->toArray(),
                            'senderId' => $sender->getId()
                        ]
                    );
                    $this->publishService->publish($message);
                    return [
                        'session' => $session->toArray(),
                        'receiverPublicKey' => $receiverPublicKey->getKey()
                    ];
                }
            }
        }
        throw new \Exception('Трапилась помилка при створенні нової сесії');
    }
}
