<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 23.09.2019
 * Time: 18:02
 */

namespace App\Factory\User;

use App\Domains\Entities\User\UserInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface UserFactoryInterface
 * @package App\Factory\User
 */
interface UserFactoryInterface
{

    /**
     * @param ServerRequestInterface $serverRequest
     * @return UserInterface
     */
    public function makeUserFromSignUpRequest(ServerRequestInterface $serverRequest): UserInterface;

    /**
     * @param string $encodedFile
     * @return string
     */
    public function makeImageToUser(string $encodedFile): string;

}
