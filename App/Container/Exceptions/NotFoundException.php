<?php

namespace App\Container\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class NotFoundException extends Exception implements NotFoundExceptionInterface
{

    const ERROR_MESSAGE = "Container error:";

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = static::ERROR_MESSAGE . " definition {$message} was not found.";
        parent::__construct($message, $code, $previous);
    }
}