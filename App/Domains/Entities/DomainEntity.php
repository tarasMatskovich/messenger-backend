<?php


namespace App\Domains\Entities;


use orm\mapper\DomainMapperException;

abstract class DomainEntity implements DomainEntityInterface
{

    /**
     * @param array $data
     * @throws \ReflectionException
     * @throws DomainMapperException
     */
    public function fill(array $data)
    {
        if (!$this->mapping)
            throw new DomainMapperException("Entity " . static::class. " should have a required field mapping");
        $reflection = new \ReflectionClass(static::class);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($properties as $property) {
            $name = $property->getName();
            if ($name !== 'mapping' && isset($this->mapping[$name]))
                $this->$name = $data[$this->mapping[$name]] ?? null;
        }
    }

}