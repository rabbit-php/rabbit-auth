<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/20
 * Time: 3:27
 */

namespace rabbit\auth;

/**
 * Class HttpBearerAuth
 * @package rabbit\auth
 */
class HttpBearerAuth extends HttpHeaderAuth
{
    /**
     * {@inheritdoc}
     */
    protected $header = 'Authorization';
    /**
     * {@inheritdoc}
     */
    protected $pattern = '/^Bearer\s+(.*?)$/';
}
