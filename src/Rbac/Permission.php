<?php

use Illuminate\Support\Collection;
use Jrn\Rbac\Contracts\Permission as PermissionContract;
use Illuminate\Support\Facades\DB;
use Jrn\Rbac\Rbac\Init;
use Jrn\Rbac\Exceptions\RoleExists;

class Permissiona extends Init implements PermissionContract {
    
    public static function roles(int|string $permission): Collection
    {
        return new Collection();
    }

    public static function find(string|int $name): int 
    {
        return 1;
    }

    public static function create(string $name, string $display, string $description): int
    {
        
        return DB::table(static::_table())->insert([
            'name' => $name, 
            'display_name' => $display,
            'description' => $description
        ]);
    }
}