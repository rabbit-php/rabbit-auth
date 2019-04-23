<?php
namespace rabbit\auth\JWT;

use rabbit\core\Exception;

/**
 * Class BeforeValidException
 * @package rabbit\auth\JWT
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
