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

    /**
     * @param $name
     * @return void
     */
    public function setName($name);

    /**
     * @return array
     */
    public function toArray();

}
