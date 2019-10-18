<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 18.10.2019
 * Time: 12:57
 */

namespace actions\user\edit;


use actions\ActionInterface;
use App\Domains\Repository\User\UserRepositoryInterface;
use App\Factory\User\UserFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class EditUser
 * @package actions\user\edit
 */
class EditUser implements ActionInterface
{

    /**
     * @var UserFactoryInterface
     */
    private $userFactory;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * EditUser constructor.
     * @param UserFactoryInterface $userFactory
     */
    public function __construct(UserFactoryInterface $userFactory, UserRepositoryInterface $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $user = $this->userFactory->makeUserFromEditRequest($request);
        $this->userRepository->save($user);
        return [];
    }
}
