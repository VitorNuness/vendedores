<?php

namespace Sellers\Authentication\DTO;

readonly class UserDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }
}
