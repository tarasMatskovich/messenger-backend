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
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param $phone
     * @return void
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param $image
     * @return void
     */
    public function setImage($image);

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @param $password
     * @return void
     */
    public function setPassword($password);

    /**
     * @return array
     */
    public function toArray();

}
