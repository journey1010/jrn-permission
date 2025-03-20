<?php 
    
namespace Jrn\Rbac\Trait;

use Illuminate\Support\Collection;
use Jrn\Rbac\Contracts\Role as RoleContract;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class Role implements RoleContract{

    protected static $table = Config('jrnRbac.tables.roles'); 
        
    public static function permission(string|int $role): Collection
    {
        return new Collection(); 
    }

    public static function find(string|int $role): int
    {
        return 1; 
    }

    public static function findOrCreate(string $name): int
    { 
        $role = DB::table(static::$table)->where('name', str_replace(' ', '', strtolower($name)))->first();
        if(is_null($role)){
            
        }
        return 1; 
    } 
}