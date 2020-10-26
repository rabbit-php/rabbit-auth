<?php
declare(strict_types=1);

namespace Rabbit\Auth;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthMethod
 * @package Rabbit\Auth
 */
abstract class AuthMethod
{
    const AUTH_TOKEN_STRING = 'auth_token_string';

    /**
     * @Author Albert 63851587@qq.com
     * @DateTime 2020-10-26
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return string|null
     */
    abstract public function authenticate(ServerRequestInterface $request): ?string;
}
