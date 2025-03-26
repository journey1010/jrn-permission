<?php

namespace Jrn\Rbac\Test;

use Orchestra\Testbench\TestCase;
use Jrn\Rbac\Rbac\Init;
use InvalidArgumentException;

class InitTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app['config']->set('jrnRbac.tables.roles', 'roles');
        $this->app['config']->set('jrnRbac.tables.permissions', 'permissions');
        $this->app['config']->set('jrnRbac.tables.role_user', 'role_user');
        $this->app['config']->set('jrnRbac.tables.permission_user', 'permission_user');
        $this->app['config']->set('jrnRbac.table.permission_role', 'permission_role');
    }
    public function testEnsureInitInitializesCorrectly()
    {
        // Configuramos la clave estática requerida
        Init::$configkey = 'roles';

        // Forzamos la inicialización
        $table = Init::_table();

        // Verificamos que la propiedad estática se inicializó con la tabla correcta
        $this->assertEquals('roles', $table);
    }

    public function testEnsureInitThrowsExceptionForInvalidConfigKey()
    {
        // Configuramos un configkey no permitido
        Init::$configkey = 'invalid_key';
        Init::$table = null;
        Init::$initialized = false;

        // Verificamos que se lanza una excepción InvalidArgumentException
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('config key not allowed');
        // Forzamos la inicialización
        Init::_table();
    }
}
