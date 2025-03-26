<?php

namespace Jrn\Rbac\Rbac;

use InvalidArgumentException;

class Init {

    public static bool $initialized = false; 

    public static ?string $table = null;

    public static $configkey;

    public static $tables ;

    public static ?string $permissionTable = null;
    
    public static ?string $roleTable = null;
    
    public static ?string $permissionRoleTable = null;
    
    public static ?string $roleUser = null;

    public static function ensureInit(): void
    {
        if(static::$initialized === false){
            if(static::$table === null){
                if(!in_array(static::$configkey, ['roles', 'permissions'])){
                    throw new InvalidArgumentException('config key not allowed');
                }
                static::$table = config('jrnRbac.tables.' . static::$configkey);
            }            
            static::$initialized = true;  
        }
    }

    public static function _table(): string
    {
        static::ensureInit();
        return static::$table;
    }

    public static function _forRole(): void
    {
        if(static::$permissionRoleTable === null){
            static::$permissionRoleTable = config('jrnRbac.table.permission_role');
        }   

        if(static::$permissionTable === null){
            static::$permissionTable = config('jrnRbac.table.permissions');
        }
    }
}