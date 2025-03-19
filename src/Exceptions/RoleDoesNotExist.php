<?php

namespace Jrn\Rbac\Exceptions;

use InvalidArgumentException;

class RoleDoesNotExist extends InvalidArgumentException
{

    public static function name(string $roleName)
    {
        return new static("There is no role named `{$roleName}`");
    }

    /**
     * @param  int  $roleId
     * @return static
     */
    public static function id(string $roleId)
    {
        return new static("There is no role with ID `{$roleId}`");
    }
}