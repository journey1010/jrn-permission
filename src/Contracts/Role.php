<?php

namespace Jrn\Rbac\Contracts;

use Illuminate\Support\Collection; 

interface Role {
    /**
     * retrive permissions linked to roles
     * @throws \Jrn\Rbac\Exceptions\RoleDoesNotExist
     */
    public static function permission(string|int $role): collection; 
    
    /**
     * Find role by its name or primary key id
     * @throws Jrn\Rbac\Exceptions\RoleDoesNotExist
     * @return int if it's found 
    */
    public static function find(string|int $role): int;
    
    /**
     * Find or create role
     */
    public static function findOrCreate(string $name): int; 
}