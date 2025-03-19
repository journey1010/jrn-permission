<?php

namespace Jrn\Rbac\Contracts;

use Illuminate\Support\Collection;

interface Permission {
    /**
     * retrive roles linked to permissions
     */
    public static function roles(): Collection;

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