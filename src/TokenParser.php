<?php

declare(strict_types=1);

namespace Rabbit\Auth;


use Rabbit\Auth\JWT\JWTInterface;


class TokenParser implements TokenInterface
{
    protected int $duration = 30 * 60;
    protected string $issuser = "rabbit.com";
    protected string $secret = "rabbit)*#";
    protected ?string $kid = null;


    /**
     * Auth constructor.
     * @param JWTInterface $jwt
     */
    public function __construct(protected JWTInterface $jwt)
    {
    }

    /**
     * @param string $id
     * @param array $claim
     * @return string
     */
    public function getToken(string $id, array $claim = []): string
    {
        $time = time();
        $token = [
            ...$claim,
            "iss" => $this->issuser,
            "iat" => $time,
            'id' => $id
        ];
        return $this->kid !== null ? $this->jwt->encode($this->secret, $token, ['kid' => $this->kid])
            : $this->jwt->encode($this->secret, $token);
    }

    /**
     * @param string $token
     * @return Object
     */
    public function parseToken(string $token): Object
    {
        return $this->jwt->decode($token, [$this->secret], array('HS256'));
    }
}
