<?php

namespace Jrn\Rbac\Contracts;

use Illuminate\Support\Collection;

interface Permission {
    /**
     * retrive roles linked to permissions
     * @throws \Jrn\Rbac\Exceptions\PermissionDoesNotExist
     * 
     */
    public static function roles(int|string $permission): Collection;

    /**
     * @throws \Jrn\Rbac\Exceptions\PermissionDoesNotExist
     * @return int if it's found 
     */
    public static function find(string|int $name): int; 

    /**
     * Find or Create permission by its name
    */
    public static function findOrCreate(string $name): int;
}