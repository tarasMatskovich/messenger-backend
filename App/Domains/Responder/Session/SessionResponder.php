<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 11:00
 */

namespace App\Domains\Responder\Session;


use App\Domains\Entities\Message\MessageInterface;
use App\Domains\Entities\Session\SessionInterface;
use App\Domains\Entities\User\UserInterface;
use App\Domains\Repository\Message\MessageRepositoryInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\StorageService\StorageServiceInterface;

/**
 * Class SessionResponder
 * @package App\Domains\Responder\Session
 */
class SessionResponder implements SessionResponderInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * @var StorageServiceInterface
     */
    private $storageService;

    /**
     * SessionResponder constructor.
     * @param UserRepositoryInterface $userRepository
     * @param MessageRepositoryInterface $messageRepository
     * @param StorageServiceInterface $storageService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        MessageRepositoryInterface $messageRepository,
        StorageServiceInterface $storageService
    )
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
        $this->storageService = $storageService;
    }

    /**
     * @param SessionInterface $session
     * @return MessageInterface|null
     */
    private function getLastMessage(SessionInterface $session)
    {
        $messages = $this->messageRepository
            ->findBy(
                [
                    'sessionId' => $session->getId(),
                    'type' => 0
                ],
                [
                    'id' => 'DESC'
                ]
            );
        if (isset($messages[0])) {
            return $messages[0];
        }
        return null;
    }

    /**
     * @param MessageInterface $message
     * @return array|null
     */
    private function getUser(MessageInterface $message)
    {
        $user = $this->userRepository->find($message->getUserId());
        if (null !== $user) {
            $userArray = $user->toArray();
            $userArray['image'] = $this->storageService->getBase64FromFile($user->getImage());
            return $userArray;
        }
        return null;
    }

    /**
     * @param SessionInterface[] $sessions
     * @return array
     */
    public function respondExtendedList(array $sessions)
    {
        $result = [];
        foreach ($sessions as $session) {
            $data = [];
            $data['sessionId'] = $session->getId();
            $lastMessage = $this->getLastMessage($session);
            $lastMessageArray = null;
            $data['user'] = null;
            if (null !== $lastMessage) {
                $lastMessageArray = $lastMessage->toArray();
                $lastMessageArray['user'] = $this->getUser($lastMessage);
                // TODO REMOVE!!!!!
                $lastMessageArray['date'] = '19:45';
                $data['user'] = $this->getUser($lastMessage);
            }
            $data['lastMessage'] = $lastMessageArray;
            $result[] = $data;
        }
        return $result;
    }
}
