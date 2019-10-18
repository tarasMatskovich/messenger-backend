<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 12:31
 */

namespace actions\user\get;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Responder\User\UserResponderInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetUser
 * @package actions\user\get
 */
class GetUser implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserResponderInterface
     */
    private $userResponder;

    /**
     * GetUser constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserResponderInterface $userResponder
     */
    public function __construct(UserRepositoryInterface $userRepository, UserResponderInterface $userResponder)
    {
        $this->userRepository = $userRepository;
        $this->userResponder = $userResponder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $userId = $request->getAttribute('userId');
        if (null !== $userId) {
            $user = $this->userRepository->find($userId);
            if (null !== $user) {
                return [
                    'user' => $this->userResponder->respondUser($user)
                ];
            }
        }
        throw new \Exception('Користувача не було знайдено', 500);
    }
}
