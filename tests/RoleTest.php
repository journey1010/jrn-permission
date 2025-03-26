<?php

namespace Jrn\Rbac\Test;

use Illuminate\Support\Facades\DB;
use Orchestra\Testbench\TestCase;
use Jrn\Rbac\Exceptions\RoleExists;
use Jrn\Rbac\Rbac\Role;

class RoleTest extends TestCase
{
    public function testCreateRoleSuccessfully()
    {
        // Actúa creando un nuevo rol
        $roleId = Role::create('Admin', 'Administrator', 'Role for admin users');

        // Asegúrate de que el rol ha sido creado en la base de datos
        $this->assertDatabaseHas('roles', [
            'id' => $roleId,
            'name' => 'Admin',
            'display_name' => 'Administrator',
            'description' => 'Role for admin users',
        ]);
    }

    public function testCreateRoleThrowsRoleExistsException()
    {
        // Primero, crea un rol para que ya exista en la base de datos
        Role::create('Admin', 'Administrator', 'Role for admin users');

        // Intenta crear otro rol con el mismo nombre y verifica que lanza una excepción
        $this->expectException(RoleExists::class);

        Role::create('Admin', 'Administrator Duplicate', 'This should fail');
    }

    public function testGetPermissionsByRoleName()
    {
        // Simula una configuración básica
        DB::table('roles')->insert(['id' => 1, 'name' => 'Admin']);
        DB::table('permissions')->insert(['id' => 1, 'name' => 'Edit Articles']);
        DB::table('permission_role')->insert([
            'role_id' => 1,
            'permission_id' => 1,
        ]);

        // Actúa obteniendo los permisos del rol
        $permissions = Role::permission('Admin');

        // Verifica que se devolvió el permiso asociado al rol
        $this->assertCount(1, $permissions);
        $this->assertEquals('Edit Articles', $permissions->first()->name);
    }

    public function testGetPermissionsByRoleId()
    {
        // Simula otra configuración para un rol
        DB::table('roles')->insert(['id' => 2, 'name' => 'Editor']);
        DB::table('permissions')->insert(['id' => 2, 'name' => 'Publish Articles']);
        DB::table('permission_role')->insert([
            'role_id' => 2,
            'permission_id' => 2,
        ]);

        // Actúa obteniendo los permisos del rol por ID
        $permissions = Role::permission(2);

        // Verifica que el permiso esté relacionado con el rol
        $this->assertCount(1, $permissions);
        $this->assertEquals('Publish Articles', $permissions->first()->name);
    }
}
