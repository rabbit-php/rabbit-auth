<?php
namespace rabbit\auth\JWT;

use rabbit\core\Exception;

/**
 * Class SignatureInvalidException
 * @package rabbit\auth\JWT
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
