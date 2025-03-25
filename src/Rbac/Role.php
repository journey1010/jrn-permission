<?php 
    
namespace Jrn\Rbac\Trait;

use Illuminate\Support\Collection;
use Jrn\Rbac\Contracts\Role as RoleContract;
use Illuminate\Support\Facades\DB;
use Jrn\Rbac\Rbac\Init;
use Jrn\Rbac\Exceptions\RoleExists;

class Role extends Init implements RoleContract{

    protected static $configkey = 'roles';

    public static function create(string $name, string $display, string $description): int
    { 
        $role = DB::table(static::_table())
            ->whereRaw('LOWER(REPLACE(name, " ", "")) = ?', [$name])
            ->first();
        if($role){
            throw RoleExists::create($name);
        }
        return DB::table(static::_table())->insertGetId([
            'name' => $name,
            'display_name' => $display,
            'description' => $description
        ]);
    } 

    public static function permission(string|int $role): Collection
    {
        $query = DB::table(static::$permisionRoleTable)
            ->join(static::$permissionTable, static::$permissionTable. '.id', static::$permisionRoleTable . '.permision_id');
        if(!is_integer($role)){
            $query->join(static::$table, static::$table . '.id', static::$permisionRoleTable . '.role_id')
            ->where(static::$table . '.name', $role);
        }
        return $query->where(static::$permisionRoleTable . '.role_id', $role)->get();
    }


    public static function find(string|int $role): int
    {
        return 1;
    }
}