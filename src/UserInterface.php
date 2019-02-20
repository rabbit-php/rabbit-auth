<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 14:16
 */

namespace rabbit\auth;

/**
 * Interface UserInterface
 * @package rabbit\auth
 */
interface UserInterface
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return array
     */
    public function getUser(): array;

    /**
     * @return string
     */
    public function getToken(): string;
}