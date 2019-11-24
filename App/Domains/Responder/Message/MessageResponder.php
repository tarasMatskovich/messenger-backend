<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 07.10.2019
 * Time: 10:50
 */

namespace App\Domains\Responder\Message;


use App\Domains\Entities\Message\MessageInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Responder\User\UserResponderInterface;

/**
 * Class MessageResponder
 * @package App\Domains\Responder\Message
 */
class MessageResponder implements MessageResponderInterface
{

    /**
     * @var UserResponderInterface
     */
    private $userResponder;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * MessageResponder constructor.
     * @param UserResponderInterface $userResponder
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserResponderInterface $userResponder,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userResponder = $userResponder;
        $this->userRepository = $userRepository;
    }

    /**
     * @param MessageInterface[] $messages
     * @return mixed
     */
    public function respondMessagesList(array $messages)
    {
        $data = [];
        foreach ($messages as $message) {
            $data[] = [
                'message' => $this->respondMessage($message)
            ];
        }
        return $data;
    }

    /**
     * @param MessageInterface $message
     * @return array
     */
    public function respondMessage(MessageInterface $message)
    {
        $userId = $message->getUserId();
        $createdById = $message->getCreatedBy();
        if (null !== $userId && null !== $createdById) {
            $user = $this->userRepository->find($userId);
            $createdBy = $this->userRepository->find($createdById);
            if (null !== $user && null !== $createdBy) {
                $messageData = $message->toArray();
                $messageData['user'] = $this->userResponder->respondUser($createdBy);
                return $messageData;
            }
        }
        return [];
    }
}
