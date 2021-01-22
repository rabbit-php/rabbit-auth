<?php

declare(strict_types=1);

namespace Rabbit\Auth\JWT;

use Psr\Http\Message\ServerRequestInterface;
use Rabbit\Auth\TokenInterface;

interface JWTAuthInterface
{
    public function auth(ServerRequestInterface $request): bool;
    public function getAuth(): TokenInterface;
}
