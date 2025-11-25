<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;


class RolesSeeder extends Seeder
{
     /**
     * ===================================
     * SEEDER DE ROLES
     * ===================================
     * Función: Crear roles y asignar permisos previamente creados en PermissionsSeeder.
     * Ejemplo: "Super Admin", "Admin Organizador", "Expositor", "Asistente", "Invitado".
     */
    public function run(): void
    {
        // Crear roles
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin      = Role::firstOrCreate(['name' => 'Admin Organizador']);
        $speaker    = Role::firstOrCreate(['name' => 'Expositor']);
        $user       = Role::firstOrCreate(['name' => 'Asistente']);
        $guest      = Role::firstOrCreate(['name' => 'Invitado']);

        /**
         * ===================================
         * ASIGNAR PERMISOS A ROLES
         * ===================================
         */

        // Super Admin → Todos los permisos
        $superAdmin->givePermissionTo(Permission::all());

        // Admin Organizador → permisos administrativos
        $admin->givePermissionTo([
            'crear_eventos', 
            'editar_eventos', 
            'eliminar_eventos', 
            'ver_eventos', 
            'gestionar_agenda',
            'crear_talleres', 
            'editar_talleres', 
            'eliminar_talleres', 
            'ver_talleres',
            'crear_city_tours', 
            'editar_city_tours', 
            'eliminar_city_tours',
            'crear_planes', 
            'editar_planes', 
            'eliminar_planes', 
            'ver_planes',
            'crear_noticias', 
            'editar_noticias', 
            'eliminar_noticias', 
            'ver_noticias',
            'gestionar_usuarios', 
            'asignar_roles', 
            'ver_roles',
            'ver_reseñas', 
            'moderar_reseñas',
        ]);

        // Expositor → puede ver sus eventos y agenda
        $speaker->givePermissionTo([
            'ver_eventos', 
            'ver_agenda', 
            'ver_talleres'
        ]);

        // Asistente → puede inscribirse y dejar reseñas
        $user->givePermissionTo([
            'ver_eventos', 
            'ver_talleres', 
            'inscribirse_talleres', 
            'ver_agenda',
            'inscribirse_city_tours', 
            'comprar_planes',
            'crear_reseñas', 
            'ver_reseñas',
        ]);

        // Invitado → solo ver info pública
        $guest->givePermissionTo([
            'ver_eventos', 
            'ver_talleres', 
            'ver_agenda', 
            'ver_noticias',
        ]);
    }
}
