<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 3:06
 */

namespace rabbit\auth;


use Psr\Http\Message\ServerRequestInterface;

/**
 * Class HttpHeaderAuth
 * @package rabbit\auth
 */
class HttpHeaderAuth extends AuthMethod
{
    /**
     * @var string the HTTP header name
     */
    protected $header = 'X-Api-Key';
    /**
     * @var string a pattern to use to extract the HTTP authentication value
     */
    protected $pattern;


    /**
     * @param ServerRequestInterface $request
     * @return bool
     */
    public function authenticate(ServerRequestInterface $request): bool
    {
        $authHeader = $request->getHeaderLine($this->header);

        if ($authHeader) {
            if ($this->pattern !== null) {
                if (preg_match($this->pattern, $authHeader, $matches)) {
                    $authHeader = $matches[1];
                } else {
                    return false;
                }
            }
            $request->withAttribute(self::AUTH_TOKEN, $authHeader);
            return true;
        }

        return false;
    }
}