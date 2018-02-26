<?php
declare(strict_types = 1);

namespace App\Exceptions;

use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Response;

class ControllerExceptionHandler
{
    /**
     * @param \Symfony\Component\Debug\Exception\FlattenException $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function exceptionAction(FlattenException $exception)
    {
        $msg = 'Oops! : '.$exception->getMessage();
        return new Response($msg, $exception->getStatusCode());
    }
}
