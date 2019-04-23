<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 19:47
 */

namespace rabbit\auth;

/**
 * Interface AuthInterface
 * @package rabbit\auth
 */
interface AuthInterface
{
    /**
     * @param string $token
     * @return Object
     */
    public function parseToken(string $token): Object;

    /**
     * @param string $id
     * @return string
     */
    public function getToken(string $id, array $claim = []): string;
}