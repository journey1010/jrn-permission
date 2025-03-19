<?php

namespace Jrn\Rbac\Exceptions;

use InvalidArgumentException;

class PermissionDoesNotExist extends InvalidArgumentException
{

    public static function name(string $permissionName)
    {
        return new static("There is no permission named `{$permissionName}`");
    }

    /**
     * @param  int  $permissionId
     * @return static
     */
    public static function id(string $permissionId)
    {
        return new static("There is no permission with ID `{$permissionId}`");
    }
}