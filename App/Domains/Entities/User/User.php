<?php


namespace App\Domains\Entities\User;

use App\Domains\Entities\DomainEntity;
use orm\annotations\map;
use orm\annotations\MyAnnotation;

/**
 * Class User
 * @package App\Domains\Entities\User
 * @MyAnnotation(gateway="table.users")
 */
class User extends DomainEntity implements UserInterface
{

    /**
     * @var int
     * @MyAnnotation(field="id")
     */
    protected $id;

    /**
     * @var string
     * @MyAnnotation(field="name")
     */
    protected $name;

    /**
     * User constructor.
     * @param string $name
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

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