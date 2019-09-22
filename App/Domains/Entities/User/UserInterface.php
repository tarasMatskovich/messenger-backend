<?php


namespace App\Domains\Entities\User;

/**
 * Interface UserInterface
 * @package App\Domains\Entities\User
 */
interface UserInterface
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