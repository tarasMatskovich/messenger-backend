<?php


namespace App\Router\Enum;

/**
 * Class HttpMethodsEnum
 * @package App\Router\Enum
 */
class HttpMethodsEnum
{

    const POST = 'POST';

    const GET = 'GET';

    const DELETE = 'DELETE';

    const PUT = 'PUT';

    const AVAILABLE_METHODS = [
        self::GET,
        self::POST,
        self::DELETE,
        self::PUT
    ];

}