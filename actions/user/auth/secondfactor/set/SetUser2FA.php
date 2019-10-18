<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 15:39
 */

namespace actions\user\auth\secondfactor\set;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\AuthenticationService\SecondFactorAuthTypesEnum;
use App\Domains\Service\UserTOTPService\UserTOTPServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SetUser2FA
 * @package actions\user\auth\secondfactor\set
 */
class SetUser2FA implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserTOTPServiceInterface
     */
    private $userTOTPService;

    /**
     * SetUser2FA constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserTOTPServiceInterface $userTOTPService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserTOTPServiceInterface $userTOTPService
    )
    {
        $this->userRepository = $userRepository;
        $this->userTOTPService = $userTOTPService;
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
                $secondFactor = $request->getAttribute('secondFactor');
                if (null !== $secondFactor) {
                    switch ($secondFactor) {
                        case SecondFactorAuthTypesEnum::TOTP:
                            $code = $request->getAttribute('code');
                            if (null === $code) {
                                throw new \Exception('Невірний код');
                            }
                            if (!$this->userTOTPService->checkCode($user, $code)) {
                                throw new \Exception('Невірний код');
                            }
                            break;
                        case SecondFactorAuthTypesEnum::NOTHING:
                            $secondFactor = null;
                            break;

                    }
                    $user->setSecondFactor($secondFactor);
                    $this->userRepository->save($user);
                }
                return [];
            }
        }
        throw new \Exception('Немає такого користувача');
    }
}
