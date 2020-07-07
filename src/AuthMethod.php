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
    const AUTH_TOKEN = 'auth_token';

    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    abstract public function authenticate(ServerRequestInterface $request): bool;
}
