<?php
declare(strict_types=1);

namespace Rabbit\Auth\JWT;


use Rabbit\Base\Core\Exception;

/**
 * Class SignatureInvalidException
 * @package Rabbit\Auth\JWT
 */
class SignatureInvalidException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'SignatureInvalidException';
    }
}
