<?php

namespace Jrn\Rbac\Contracts;

use Illuminate\Support\Collection;
use BackedEnum;

interface User {

    /**
     * retrive all users roles 
    */
    public function role(int $user, ?string $userType = null):  Collection;
    
    /**
     * retrive all users permissions
     */
    public function permission(int $user, ?string $userType = null): Collection;

    /**
     * Check if user has role by role name or ID (int)
     * @return bool
     */
    public function hasRole(int $user, string|array|BackedEnum|int $permission, ?string $userType = null): bool; 
    
    /**
     * Check if user has permission by permision name or ID (int)
    */
    public function hasPermission(int $user, string|array|BackedEnum|int $permission, ?string $userType = null): bool;


    /**
     * Checks role(s) and permission(s)
     * @param array $options validate_all{true|false} or return_type{boolean|array|both}
     * @throws \InvalidArgumentException
    */
    public static function ability(int $user, string|array|BackedEnum|int $permission, ?string $userType = null): bool;

    /**
     *  @return true if role added successfully or false if role already exists  for this user 
    */
    public static function addRole(int $user, string|int $role, ?string $userType = null): bool;
    
    /**
     * Add role for user and excludes any role that already been added to the user
     */
    public static function addRoles(int $user, array $roles): bool;
    
    /**
     * All roles for current user will be replace by the array given
    */
    public static function syncRole(int $user, array $roles, ?string $userType = null): bool;

    /**
     * Remove any role by the array given
    */
    public static function removeRole(int $user, array $role): void;
    
    /**
     *  @return true if permission added successfully or false if role already exists  for this user 
    */
    public static function addPermission(int $user, string|array|BackedEnum $permission, ?string $userType = null): bool;

    /**
     * Add permissions for user and excludes any permission that already been added to the user
    */
    public static function addPermissions(int $user, array $permissions): bool;

    /**
     * All permission for current user will be replace by the array given
    */
    public static function syncPermission(int $user, array $permission, ?string $userType = null): bool;

    /**
     * Remove any permission by the array given
    */
    public static function removePermission(int $user, array $role): void;
    
}