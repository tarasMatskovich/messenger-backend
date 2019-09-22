<?php


namespace App\Domains\Entities\User;


/**
 * App\Domains\ORM\Mapping
 *
 * @\Doctrine\ORM\Mapping\Entity(repositoryClass="App\Domains\Repository\User\UserRepository")
 * @\Doctrine\ORM\Mapping\Table(name="users")
 */
class User implements UserInterface
{

    /**
     * @\Doctrine\ORM\Mapping\Id()
     * @\Doctrine\ORM\Mapping\GeneratedValue()
     * @\Doctrine\ORM\Mapping\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="name")
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}