<?php

declare(strict_types=1);

namespace Rabbit\Auth;

use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Rabbit\Auth\JWT\JWTAuthInterface;

class JWTAuth implements JWTAuthInterface
{
    protected TokenInterface $auth;
    public function __construct(TokenInterface $auth)
    {
        $this->auth = $auth;
    }
    /**
     * @var AuthMethod[]
     */
    protected array $authMethod = [
        [
            'class' => QueryAuth::class,
        ], [
            'class' => HttpBearerAuth::class
        ]
    ];

    /**
     * @param ServerRequestInterface $request
     * @return bool
     * @throws Throwable
     */
    public function auth(ServerRequestInterface $request): bool
    {
        foreach ($this->authMethod as $authMethod) {
            /** @var AuthMethod $authMethod */
            $authMethod = create($authMethod);
            if (null !== $strToken = $authMethod->authenticate($request)) {
                $token = $this->auth->parseToken($strToken);
                if ($token) {
                    UserContext::set($token);
                    return true;
                }
            }
        }
        return false;
    }
}
