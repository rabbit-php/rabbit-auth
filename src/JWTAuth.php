<?php

declare(strict_types=1);

namespace Rabbit\Auth;

use Throwable;
use Psr\Http\Message\ServerRequestInterface;
use Rabbit\Auth\JWT\JWTAuthInterface;

class JWTAuth implements JWTAuthInterface
{
    public function __construct(protected TokenInterface $auth)
    {
    }

    public function getAuth(): TokenInterface
    {
        return $this->auth;
    }

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
        foreach ($this->authMethod as $class) {
            $authMethod = create($class);
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
