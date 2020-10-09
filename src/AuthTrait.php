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
        $res = false;
        foreach ($this->authMethod as $authMethod) {
            /** @var AuthMethod $authMethod */
            $authMethod = create($authMethod);
            if ($authMethod->authenticate($request)) {
                /** @var AuthInterface $auth */
                $auth = getDI('auth');
                $token = $auth->parseToken($request->getAttribute(AuthMethod::AUTH_TOKEN_STRING));
                if ($token) {
                    $res = true;
                    $request->withAttribute(AuthMethod::AUTH_TOKEN, $token);
                }
            }
        }
        return $res;
    }
}
