<?php

declare(strict_types=1);

namespace Rabbit\Auth;

class UserContext
{
    public static function set(object $response): void
    {
        getContext(getRootId())['login.user'] = $response;
    }

    public static function get(): ?object
    {
        $context = getContext(getRootId());
        if ($context && isset($context['login.user'])) {
            return $context['login.user'];
        }
        return null;
    }
}
