<?php
declare(strict_types=1);

namespace Rabbit\Auth\JWT;

/**
 * Interface JWTInterface
 * @package rabbit\auth\JWT
 */
interface JWTInterface
{
    /**
     * @param string $jwt
     * @param array $key
     * @param array $allowed_algs
     * @return Object
     */
    public function decode(string $jwt, array $key, array $allowed_algs = array()): Object;

    /**
     * @param string $key
     * @param array $payload
     * @param array $head
     * @return string
     */
    public function encode(string $key, array $payload, array $head = []): string;
}
