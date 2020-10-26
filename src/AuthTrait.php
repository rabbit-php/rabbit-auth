<?php

declare(strict_types=1);

namespace Rabbit\Auth;

use Throwable;
use Psr\Http\Message\ServerRequestInterface;

trait AuthTrait
{
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
                /** @var AuthInterface $auth */
                $auth = getDI('auth');
                $token = $auth->parseToken($strToken);
                if ($token) {
                    UserContext::set($token);
                    return true;
                }
            }
        }
        return false;
    }
}
