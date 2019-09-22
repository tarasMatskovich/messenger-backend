<?php


namespace App\Domains\Entities;

/**
 * Interface DomainEntityInterface
 * @package App\Domains\Entities
 */
interface DomainEntityInterface
{
    /**
     * @param array $data
     * @return void
     */
    public function fill(array $data);
}