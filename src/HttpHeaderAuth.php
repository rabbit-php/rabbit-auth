<?php
declare(strict_types=1);

namespace Rabbit\Auth;

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
    protected string $header = 'X-Api-Key';
    /**
     * @var string a pattern to use to extract the HTTP authentication value
     */
    protected string $pattern;


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
            $request->withAttribute(self::AUTH_TOKEN_STRING, $authHeader);
            return true;
        }

        return false;
    }
}
