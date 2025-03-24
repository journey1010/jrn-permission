<?php 
    
namespace Jrn\Rbac\Trait;

use Illuminate\Support\Collection;
use Jrn\Rbac\Contracts\Role as RoleContract;
use Illuminate\Support\Facades\DB;
use Jrn\Rbac\Rbac\Init;
use Jrn\Rbac\Exceptions\RoleExists;
use PhpParser\Node\Expr\FuncCall;

class Role extends Init implements RoleContract{
    
    protected static $roleAs = 'rls';
    protected static $permissionAs = 'prms';
    protected static $permissionRoleAs = 'prmsr';
    protected static $relationships = [
        'user' => 'role_user',
        'permission' => 'permission_role'
    ];
    protected static $foreginKey = 'role_id';

    protected static $permissionTable = 'permission';
    protected static $permissionTableForeign = 'permission_id';

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
        DB::table(static::$relationships['permission'])
            ->join(static::, static::$permissionRoleAs . '.'. static::$foreginKey , static::$roleAs . '.id')
            ->join(static::_permissionAs(), static::$permissionAs . '.id', static::)
            ->get();
    }


    public static function find(string|int $role): int
    {
        return 1; 
    }
}