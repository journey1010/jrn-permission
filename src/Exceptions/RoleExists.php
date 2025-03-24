<?php

namespace Jrn\Rbac\Exceptions;

use InvalidArgumentException;

class RoleExists extends InvalidArgumentException
{
    public static function create(string $roleName)
    {
        return new static("This role already exists : `{$roleName}`");
    }
}