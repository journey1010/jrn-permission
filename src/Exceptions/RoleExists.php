<?php

namespace Jrn\Rbac\Exceptions;

use InvalidArgumentException;

class RoleExists extends InvalidArgumentException
{
    public static function create(string $name)
    {
        return new static("This role already exists : `{$name}`");
    }
}