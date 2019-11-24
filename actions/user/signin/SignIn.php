<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 16:17
 */

namespace actions\user\signin;


use actions\ActionInterface;
use App\Domains\Entities\User\UserInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Domains\Service\AuthenticationService\AuthenticationServiceInterface;
use App\Request\Exception\NotAuthenticatedException;
use Psr\Http\Message\ServerRequestInterface;

class SignIn implements ActionInterface
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
     * SignIn constructor.
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
     * @throws NotAuthenticatedException
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $email = $request->getAttribute('email');
        $password = $request->getAttribute('password');
        $user = $this->userRepository->findOneBy(['email' => $email]);
        if (null === $user) {
            throw new NotAuthenticatedException('Користувача за таким email немає у системі', 403);
        }
        if (!$this->authenticationService->verifyUser($user, $password)) {
            throw new NotAuthenticatedException('Не вірний пароль. Спробуйте ще раз', 403);
        }
        $code = $request->getAttribute('code', '');
        if ($this->isSecondFactorRequired($user) && '' === $code) {
            throw new NotAuthenticatedException('У вас ввімкнена двохфакторна аутентицікація - введіть код');
        }
        $r1 = $this->authenticationService->checkCode($user, $code);
        if ($this->isSecondFactorRequired($user) && '' !== $code && !$this->authenticationService->checkCode($user, $code)) {
            throw new NotAuthenticatedException('Ви ввели неправильний код, будь ласка спробуйте ще раз');
        }
        $r2 = $this->authenticationService->checkCode($user, $code);
        $token = $this->authenticationService->createToken($user);
        return [
            'user' => $user->toArray(),
            'token' => $token
        ];

    }

    /**
     * @param UserInterface $user
     * @return bool
     */
    private function isSecondFactorRequired(UserInterface $user): bool
    {
        $secondFactor = $user->getSecondFactor();
        return (bool)$secondFactor;
    }
}
