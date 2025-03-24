<?php

namespace Jrn\Rbac\Rbac;

class Init {

    protected static bool $initialized = false; 
    protected static $table; 

    protected static function ensureInit(): void
    {
        if(static::$initialized === false){
            if(!isset(static::$table)){
                static::$table = Config('jrnRbac.tables.roles');
            } 
            static::$initialized = true;  
        }
    }

    protected static function _table(): string
    {
        static::ensureInit();
        return static::$table;
    }


}