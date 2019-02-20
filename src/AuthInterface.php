<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 19:47
 */

namespace rabbit\auth;

use Lcobucci\JWT\Token;

/**
 * Interface AuthInterface
 * @package rabbit\auth
 */
interface AuthInterface
{
    /**
     * @param string $token
     * @return Token
     */
    public function parseToken(string $token): Token;

    /**
     * @param string $id
     * @return string
     */
    public function getToken(string $id): string;
}