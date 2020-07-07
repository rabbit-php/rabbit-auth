<?php
declare(strict_types=1);

namespace Rabbit\Auth\JWT;


use Rabbit\Base\Core\Exception;

/**
 * Class ExpiredException
 * @package Rabbit\Auth\JWT
 */
class ExpiredException extends Exception
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'ExpiredException';
    }
}
