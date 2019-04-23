<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 14:14
 */

namespace rabbit\auth;

use rabbit\auth\JWT\JWTInterface;

/**
 * Class Auth
 * @package rabbit\auth
 */
class Auth implements AuthInterface
{
    /** @var float|int */
    protected $duration = 30 * 60;
    /** @var string */
    protected $issuser = "rabbit.com";
    /** @var string */
    protected $secret = "rabbit)*#";
    /** @var JWTInterface */
    protected $jwt;
    /** @var string|null */
    protected $kid = null;


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
     * @return string
     */
    public function getToken(string $id, array $claim = []): string
    {
        $time = time();
        $token = array(
            "iss" => $this->issuser,
            "iat" => $time,
            'id' => $id
        );
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