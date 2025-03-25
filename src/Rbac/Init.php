<?php

namespace Jrn\Rbac\Rbac;

use InvalidArgumentException;

class Init {

    protected static bool $initialized = false; 

    protected static ?string $table = null;

    protected static $configkey;

    protected static $tables ;

    protected static ?string $permissionTable = null;
    
    protected static ?string $roleTable = null;
    
    protected static ?string $permisionRoleTable = null;
    
    protected static ?string $roleUser = null;

    protected static function ensureInit(): void
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

    protected static function _table(): string
    {
        static::ensureInit();
        return static::$table;
    }

    protected static function _forRole(): void
    {
        if(static::$permisionRoleTable === null){
            static::$permisionRoleTable = config('jrnRbac.table.permission_role');
        }   

        if(static::$permissionTable === null){
            static::$permissionTable = config('jrnRbac.table.permissions');
        }
    }
}