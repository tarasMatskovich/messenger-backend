<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 30.09.2019
 * Time: 10:59
 */

namespace App\Domains\Responder\Session;

use App\Domains\Entities\Session\SessionInterface;

/**
 * Interface SessionResponderInterface
 * @package App\Domains\Responder\Session
 */
interface SessionResponderInterface
{

    /**
     * @param SessionInterface[] $sessions
     * @return array
     */
    public function respondExtendedList(array $sessions);

}
