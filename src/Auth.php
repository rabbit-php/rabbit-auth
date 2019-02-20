<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 14:14
 */

namespace rabbit\auth;

use DateTimeImmutable;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Parser;

/**
 * Class Auth
 * @package rabbit\auth
 */
class Auth implements AuthInterface
{
    /** @var string */
    protected $token;
    /** @var float|int */
    protected $duration = 30 * 60;
    /** @var string */
    protected $issuser = "rabbit.com";
    /** @var string */
    protected $secret = "rabbit)*#";
    /** @var Signer */
    protected $sign;
    /** @var Parser */
    protected $parser = Parser::class;
    /** @var Signer\Key */
    protected $key = Signer\Key::class;

    /**
     * Auth constructor.
     * @param Signer $sign
     */
    public function __construct(Signer $sign)
    {
        $this->sign = $sign;
        if (!$this->parser instanceof Parser) {
            $this->parser = new Parser(getDI(\Lcobucci\Jose\Parsing\Parser::class));
        }
        if (!$this->key instanceof Signer\Key) {
            $this->key = new Signer\Key($this->secret);
        }
    }

    /**
     * @param string $id
     * @return string
     */
    public function getToken(string $id): string
    {
        $time = microtime(true);
        $token = (new Builder(getDI(\Lcobucci\Jose\Parsing\Parser::class)))->issuedBy($this->issuser)
            ->issuedAt(DateTimeImmutable::createFromFormat("U.u", $time))->identifiedBy($id);
        if ($this->duration > 0) {
            $token = $token->expiresAt(DateTimeImmutable::createFromFormat("U.u", $time + $this->duration));
        }

        return $token->getToken($this->sign, $this->key);
    }

    /**
     * @param string $token
     * @return Token
     */
    public function parseToken(string $token): Token
    {
        return $this->parser->parse($token);
    }
}