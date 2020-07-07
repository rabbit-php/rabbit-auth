<?php
declare(strict_types=1);

namespace Rabbit\Auth\JWT;


use Rabbit\Base\Core\Exception;

/**
 * Class BeforeValidException
 * @package Rabbit\Auth\JWT
 */
class BeforeValidException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'BeforeValidException';
    }
}
