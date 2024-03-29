<?php


namespace App\Domains\Responder\User;


use App\Domains\Entities\User\UserInterface;
use App\Domains\Service\StorageService\StorageServiceInterface;

/**
 * Class UserResponder
 * @package App\Domains\Responder\User
 */
class UserResponder implements UserResponderInterface
{

    /**
     * @var StorageServiceInterface
     */
    private $storageService;

    /**
     * UserResponder constructor.
     * @param StorageServiceInterface $storageService
     */
    public function __construct(StorageServiceInterface $storageService)
    {
        $this->storageService = $storageService;
    }

    /**
     * @param UserInterface[] $users
     * @return array
     */
    public function respond(array $users)
    {
        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'user' => $this->getUserFullData($user)
            ];
        }
        return $response;
    }

    /**
     * @param UserInterface $user
     * @return array
     */
    private function getUserFullData(UserInterface $user)
    {
        $userData = $user->toArray();
        $userData['image'] = $this->storageService->getBase64FromFile($userData['image']);
        return $userData;
    }

    /**
     * @param UserInterface $user
     * @return array
     */
    public function respondUser(UserInterface $user)
    {
        return $this->getUserFullData($user);
    }
}
