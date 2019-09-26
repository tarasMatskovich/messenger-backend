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
     * @\Doctrine\ORM\Mapping\Column(name="email")
     */
    private $email;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="phone")
     */
    private $phone;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="image")
     */
    private $image;

    /**
     * @\Doctrine\ORM\Mapping\Column(name="password")
     */
    private $password;

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

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'image' => $this->getImage()
        ];
    }
}
