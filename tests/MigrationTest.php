<?php

namespace Jrn\Rbac\Test;

use Orchestra\Testbench\Attributes\WithMigration; 
use function Orchestra\Testbench\workbench_path; 
use Illuminate\Support\Facades\Schema;

#[WithMigration('users')] 
Class MigrationTest extends \Orchestra\Testbench\TestCase{
    
    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(
            workbench_path('database/migrations')
        );
    }

    public function testMigrationWasLoaded()
    {
        // Asegúrate de que las tablas existan después de ejecutar las migraciones
        $this->assertTrue(Schema::hasTable('users'), 'La tabla `users` no existe.');
    }
    
}