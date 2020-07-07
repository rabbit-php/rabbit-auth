<?php
declare(strict_types=1);

namespace Rabbit\Auth;

/**
 * Interface UserInterface
 * @package Rabbit\Auth
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
