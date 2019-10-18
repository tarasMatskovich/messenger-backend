<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 18:27
 */

namespace App\Factory\User;


use App\Domains\Entities\User\User;
use App\Domains\Entities\User\UserInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\StorageService\StorageServiceInterface;
use App\Domains\Service\UserPassword\UserPasswordServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UserFactory
 * @package App\Factory\User
 */
class UserFactory implements UserFactoryInterface
{

    /**
     * @var UserPasswordServiceInterface
     */
    private $userPasswordService;

    /**
     * @var StorageServiceInterface
     */
    private $storageService;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserFactory constructor.
     * @param UserPasswordServiceInterface $userPasswordService
     * @param StorageServiceInterface $storageService
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserPasswordServiceInterface $userPasswordService,
        StorageServiceInterface $storageService,
        UserRepositoryInterface $userRepository
    )
    {
        $this->userPasswordService = $userPasswordService;
        $this->storageService = $storageService;
        $this->userRepository = $userRepository;
    }

    /**
     * @param ServerRequestInterface $serverRequest
     * @return UserInterface
     */
    public function makeUserFromSignUpRequest(ServerRequestInterface $serverRequest): UserInterface
    {
        $name = $serverRequest->getAttribute('name');
        $email = $serverRequest->getAttribute('email');
        $phone = $serverRequest->getAttribute('phone');
        $image = $this->makeImageToUser($serverRequest->getAttribute('image'));
        $password = $this->userPasswordService->generateHash($serverRequest->getAttribute('password'));
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPhone($phone);
        $user->setImage($image);
        $user->setPassword($password);
        return $user;
    }

    public function makeImageToUser(string $encodedImage): string
    {
        $filename = $this->storageService->makeUniqueFileName();
        $this->storageService->uploadFileFromBase64($encodedImage, $filename);
        return $filename;
    }

    /**
     * @param ServerRequestInterface $request
     * @return UserInterface
     */
    public function makeUserFromEditRequest(ServerRequestInterface $request): UserInterface
    {
        $userId = $request->getAttribute('userId');
        $name = $request->getAttribute('name');
        $phone = $request->getAttribute('phone');
        $image = $this->makeImageToUser($request->getAttribute('image'));
        $user = $this->userRepository->find($userId);
        $user->setName($name);
        $user->setPhone($phone);
        $user->setImage($image);
        return $user;
    }
}
