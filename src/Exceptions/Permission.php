<?php

namespace Jrn\Rbac\Exceptions;

use InvalidArgumentException;

class Permission extends InvalidArgumentException
{
    public static function create(string $name)
    {
        return new static("This permission alread");
    }
    
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