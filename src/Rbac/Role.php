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

    /**
     * Get permissions for a role (by ID or name)
     *
     * @param string|int $role
     * @return Collection
     */
    public static function permission(string|int $role): Collection
    {
        $query = DB::table(static::$permissionRoleTable)
            ->join(
                static::$permissionTable,
                static::$permissionTable.'.id',
                '=',
                static::$permissionRoleTable.'.permission_id'
            );

        if (is_string($role)) {
            $query->join(
                    static::_table(),
                    static::_table().'.id',
                    '=',
                    static::$permissionRoleTable.'.role_id'
                )
                ->where(static::_table().'.name', $role);
        } else {
            $query->where(static::$permissionRoleTable.'.role_id', $role);
        }

        return $query->get();
    }

    public static function find(string|int $role): int
    {
        return 1;
    }
}