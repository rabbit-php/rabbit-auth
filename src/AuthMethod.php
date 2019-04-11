<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 2:44
 */

namespace rabbit\auth;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface AuthMethoInterface
 * @package rabbit\auth
 */
abstract class AuthMethod
{
    const AUTH_TOKEN_STRING = 'auth_token_string';
    const AUTH_TOKEN = 'auth_token';

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    abstract function authenticate(ServerRequestInterface $request): bool;
}