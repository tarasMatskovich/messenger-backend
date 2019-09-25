<?php
/**
 * Created by PhpStorm.
 * User: t.matskovich
 * Date: 25.09.2019
 * Time: 14:48
 */

namespace App\Domains\Service\JWTService;

/**
 * Interface JWTServiceInterface
 * @package App\Domains\Service\JWTService
 */
interface JWTServiceInterface
{

    /**
     * @param array $header
     * @param array $payload
     * @return string
     */
    public function encode(array $header, array $payload): string;

}
