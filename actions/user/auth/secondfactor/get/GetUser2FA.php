<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 15:40
 */

namespace actions\user\auth\secondfactor\get;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetUser2FA
 * @package actions\user\auth\secondfactor\get
 */
class GetUser2FA implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * GetUser2FA constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    )
    {
        $this->userRepository = $userRepository;
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
                    'secondFactor' => $user->getSecondFactor()
                ];
            }
        }
        throw new \Exception('Не знайдено такого користувача');
    }
}
