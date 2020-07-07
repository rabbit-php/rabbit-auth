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
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function authenticate(ServerRequestInterface $request): bool
    {
        $query = $request->getQueryParams();
        if ($request->getQueryParams() && isset($query[$this->tokenParam])) {
            $request->withAttribute(self::AUTH_TOKEN_STRING, $query[$this->tokenParam]);
            return true;
        }
        return false;
    }
}
