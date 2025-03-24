<?php 
    
namespace Jrn\Rbac\Trait;

use Illuminate\Support\Collection;
use Jrn\Rbac\Contracts\Role as RoleContract;
use Illuminate\Support\Facades\DB;
use Jrn\Rbac\Rbac\Init;
use Jrn\Rbac\Exceptions\RoleExists;

class Role extends Init implements RoleContract{

    protected static $table; 
        
    public static function create(string $name, string $display, string $description): int
    { 
        return DB::table(static::_table())->insertGetId([
                'name' => $name,
                'display_name' => $display,
                'description' => $description
            ]);
    } 

    public static function permission(string|int $role): Collection
    {
        return new Collection(); 
    }

    public static function find(string|int $role): int
    {
        return 1; 
    }
}