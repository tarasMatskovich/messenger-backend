<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 08.10.2019
 * Time: 11:41
 */

namespace actions\user\online\getlist;


use actions\ActionInterface;
use App\Domains\Service\UserNetworkStatusService\UserNetworkStatusServiceInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class GetOnlineUserList
 * @package actions\user\online\getlist
 */
class GetOnlineUserList implements ActionInterface
{

    /**
     * @var UserNetworkStatusServiceInterface
     */
    private $userNetworkStatusService;

    /**
     * GetOnlineUserList constructor.
     * @param UserNetworkStatusServiceInterface $userNetworkStatusService
     */
    public function __construct(UserNetworkStatusServiceInterface $userNetworkStatusService)
    {
        $this->userNetworkStatusService = $userNetworkStatusService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function __invoke(ServerRequestInterface $request)
    {
        return [
            'onlineUsers' => $this->userNetworkStatusService->getOnlineUsers()
        ];
    }
}
