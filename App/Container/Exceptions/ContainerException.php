<?php


namespace App\Container\Exceptions;


use Exception;
use Psr\Container\ContainerExceptionInterface;
use Throwable;

class ContainerException extends Exception implements ContainerExceptionInterface
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Container error: unable to resolve {$message}.";
        parent::__construct($message, $code, $previous);
    }

}