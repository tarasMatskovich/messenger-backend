<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 17:11
 */

namespace actions\user\auth\secondfactor\getinfo;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetUserSecondFactorInfo
 * @package actions\user\auth\secondfactor\getinfo
 */
class GetUserSecondFactorInfo implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * GetUserSecondFactorInfo constructor.
     * @param UserRepositoryInterface $userRepository
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        AuthenticationServiceInterface $authenticationService
    )
    {
        $this->userRepository = $userRepository;
        $this->authenticationService = $authenticationService;
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
                    'qrCodeUrl' => $this->authenticationService->getQrCodeUrl($user)
                ];
            }
        }
        throw new \Exception('Немає такого користувача');
    }
}
