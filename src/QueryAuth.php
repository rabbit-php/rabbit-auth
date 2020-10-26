<?php

declare(strict_types=1);

namespace Rabbit\Auth;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class QueryAuth
 * @package Rabbit\Auth
 */
class QueryAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    private string $tokenParam = 'access-token';

    /**
     * @Author Albert 63851587@qq.com
     * @DateTime 2020-10-26
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return string|null
     */
    public function authenticate(ServerRequestInterface $request): ?string
    {
        $query = $request->getQueryParams();
        if ($request->getQueryParams() && isset($query[$this->tokenParam])) {
            return $query[$this->tokenParam];
        }
        return null;
    }
}
