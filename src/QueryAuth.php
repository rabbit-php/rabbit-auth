<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 2:49
 */

namespace rabbit\auth;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class QueryAuth
 * @package rabbit\auth
 */
class QueryAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    private $tokenParam = 'access-token';

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