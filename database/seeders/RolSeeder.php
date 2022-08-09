<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Creación de Roles con el framework Laravel/Spatie */
        $administrador = Role::create(['name' => 'Administrador']);
        $tecnico = Role::create(['name' => 'Tecnico de Convenios']);
        $auditor = Role::create(['name' => 'Auditor']);

        /* Creción de Permisos del sistema con el framework Laravel/Spatie */

        /* Permisos de Gestión de Usuarios */
        Permission::create(['name' => 'admin.usuarios.index',
                            'description' => 'Ver Tabla de Usuarios',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.create',
                            'description' => 'Registrar un Nuevo Usuario',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.edit',
                            'description' => 'Editar un Usuario',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.show',
                            'description' => 'Mostrar la Información de un Usuario',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.usuarios.destroy',
                            'description' => 'Eliminar el Registro de un Usuario',])->syncRoles([$administrador]);

        /* Permisos de Gestión de Roles */
        Permission::create(['name' => 'admin.roles.index',
                            'description' => 'Ver Tabla de Roles',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.create',
                            'description' => 'Registrar un Nuevo Rol',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.edit',
                            'description' => 'Editar un Rol',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.show',
                            'description' => 'Mostrar la Información de un Rol',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.roles.destroy',
                            'description' => 'Eliminar el Registro de un Rol',])->syncRoles([$administrador]);

        /* Permisos de Gestión de Clasificaciones */
        Permission::create(['name' => 'admin.clasificaciones.index',
                            'description' => 'Ver Tabla de Clasificaciones',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.clasificaciones.create',
                            'description' => 'Registrar una Nueva Clasificación',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clasificaciones.edit',
                            'description' => 'Editar una Clasificación',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.clasificaciones.show',
                            'description' => 'Mostrar la Información de una Clasificación',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.clasificaciones.destroy',
                            'description' => 'Eliminar el Registro de una Clasificación',])->syncRoles([$administrador]);

        /* Permisos de Gestión de Ejes de Accción */
        Permission::create(['name' => 'admin.ejes.index',
                            'description' => 'Ver Tabla de Ejes',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.ejes.create',
                            'description' => 'Registrar un Nuevo Eje',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.ejes.edit',
                            'description' => 'Editar un Eje',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.ejes.show',
                            'description' => 'Mostrar la Información de un Eje',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.ejes.destroy',
                            'description' => 'Eliminar el Registro de un Eje',])->syncRoles([$administrador]);

        /* Permisos de Gestión de Dependencias */
        Permission::create(['name' => 'admin.dependencias.index',
                            'description' => 'Ver Tabla de Dependencias',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.dependencias.create',
                            'description' => 'Registrar una Nueva Dependencia',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.dependencias.edit',
                            'description' => 'Editar una Dependencia',])->syncRoles([$administrador]);
        Permission::create(['name' => 'admin.dependencias.show',
                            'description' => 'Mostrar la Información de una Dependencia',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'admin.dependencias.destroy',
                            'description' => 'Eliminar el Registro de una Dependencia',])->syncRoles([$administrador]);

        /* Permisos de Gestión de Resoluciones */
        Permission::create(['name' => 'tecnico.resoluciones.index',
                            'description' => 'Ver Tabla de Resoluciones',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.resoluciones.create',
                            'description' => 'Registrar una Nueva Resolución',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.resoluciones.edit',
                            'description' => 'Editar una Resolución',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.resoluciones.show',
                            'description' => 'Mostrar la Información de una Resolución',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.resoluciones.destroy',
                            'description' => 'Eliminar el Registro de una Resolución',])->syncRoles([$administrador, $tecnico]);

        /* Permisos de Gestión de Coordinadores */
        Permission::create(['name' => 'tecnico.coordinadores.index',
                            'description' => 'Ver Tabla de Coordinadores',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.coordinadores.create',
                            'description' => 'Registrar un Nuevo Coordinador',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.coordinadores.edit',
                            'description' => 'Editar un Coordinador',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.coordinadores.show',
                            'description' => 'Mostrar la Información de un Coordinador',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.coordinadores.destroy',
                            'description' => 'Eliminar el Registro de un Coordinador',])->syncRoles([$administrador, $tecnico]);

        /* Permisos de Gestión de Convenios */
        Permission::create(['name' => 'tecnico.convenios.index',
                            'description' => 'Ver Tabla de Convenios',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.convenios.create',
                            'description' => 'Registrar un Nuevo Convenio',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.convenios.edit',
                            'description' => 'Editar un Convenio',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.convenios.show',
                            'description' => 'Mostrar la Información de un Convenio',])->syncRoles([$administrador, $tecnico]);
        Permission::create(['name' => 'tecnico.convenios.destroy',
                            'description' => 'Eliminar el Registro de un Convenio',])->syncRoles([$administrador, $tecnico]);

        /* Permisos de Reportes de Convenios*/
        Permission::create(['name' => 'tecnico.reporte',
                            'description' => 'Ver Reportes de Convenios',])->syncRoles([$administrador, $tecnico]);
    }
}
