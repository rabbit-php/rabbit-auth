<?php

declare(strict_types=1);

namespace Rabbit\Auth;


use Rabbit\Auth\JWT\JWTInterface;


class TokenParser implements TokenInterface
{
    /** @var int */
    protected int $duration = 30 * 60;
    /** @var string */
    protected string $issuser = "rabbit.com";
    /** @var string */
    protected string $secret = "rabbit)*#";
    /** @var JWTInterface */
    protected JWTInterface $jwt;
    /** @var string|null */
    protected ?string $kid = null;


    /**
     * Auth constructor.
     * @param JWTInterface $jwt
     */
    public function __construct(JWTInterface $jwt)
    {
        $this->jwt = $jwt;
    }

    /**
     * @param string $id
     * @param array $claim
     * @return string
     */
    public function getToken(string $id, array $claim = []): string
    {
        $time = time();
        $token = array_merge($claim, [
            "iss" => $this->issuser,
            "iat" => $time,
            'id' => $id
        ]);
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
