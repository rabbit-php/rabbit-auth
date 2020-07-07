<?php
declare(strict_types=1);

namespace Rabbit\Auth;

/**
 * Class HttpBearerAuth
 * @package Rabbit\Auth
 */
class HttpBearerAuth extends HttpHeaderAuth
{
    /**
     * {@inheritdoc}
     */
    protected string $header = 'Authorization';
    /**
     * {@inheritdoc}
     */
    protected string $pattern = '/^Bearer\s+(.*?)$/';
}
