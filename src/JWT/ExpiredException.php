<?php
namespace rabbit\auth\JWT;

use rabbit\core\Exception;

/**
 * Class ExpiredException
 * @package rabbit\auth\JWT
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
