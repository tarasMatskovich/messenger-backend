<?php


namespace App\Domains\Entities\User;

use App\Domains\Entities\DomainEntityInterface;

/**
 * Interface UserInterface
 * @package App\Domains\Entities\User
 */
interface UserInterface extends DomainEntityInterface
{

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

}