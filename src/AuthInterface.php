<?php
declare(strict_types=1);

namespace Rabbit\Auth;

/**
 * Interface AuthInterface
 * @package Rabbit\Auth
 */
interface AuthInterface
{
    /**
     * @param string $token
     * @return Object
     */
    public function parseToken(string $token): Object;

    /**
     * @param string $id
     * @param array $claim
     * @return string
     */
    public function getToken(string $id, array $claim = []): string;
}
