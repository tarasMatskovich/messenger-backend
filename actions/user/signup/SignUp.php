<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 17:59
 */

namespace actions\user\signup;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Factory\User\UserFactoryInterface;
use App\Request\Validator\Validator;
use App\Request\Validator\ValidatorInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SignUp
 * @package actions\user\signup
 */
class SignUp implements ActionInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var UserFactoryInterface
     */
    private $userFactory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * SignUp constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $userFactory
     * @param ValidatorInterface $validator
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserFactoryInterface $userFactory,
        ValidatorInterface $validator
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->validator = $validator;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request)
    {
        if (!$this->validator->validate($request, [
            'name' => [
                Validator::REQUIRED
            ],
            'email' => [
                Validator::REQUIRED
            ],
            'phone' => [
                Validator::REQUIRED
            ],
            'password' => [
                Validator::REQUIRED
            ]
        ])) {
            throw new \Exception('Заповніть всі поля для реєстрації');
        }
        $user = $this->userFactory->makeUserFromRequest($request);
        $this->userRepository->save($user);
        return [
            'user' => $user->toArray()
        ];
    }
}
