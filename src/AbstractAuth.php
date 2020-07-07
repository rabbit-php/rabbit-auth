<?php
declare(strict_types=1);

namespace Rabbit\Auth;

use Psr\Http\Message\ServerRequestInterface;
use Rabbit\Web\RequestHandlerInterface;
use Throwable;

/**
 * Class AbstractHandler
 * @package rabbit\auth
 */
abstract class AbstractAuth implements RequestHandlerInterface
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
