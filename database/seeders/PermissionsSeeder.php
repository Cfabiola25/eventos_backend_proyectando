<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;


class PermissionsSeeder extends Seeder
{
     /**
     * ===================================
     * SEEDER DE PERMISOS
     * ===================================
     * Función: Crear todos los permisos de la plataforma,
     * organizados por dominio (eventos, talleres, planes, etc.).
     */
    /**
     * Run the database seeds.
     * // ojo agregar en noticias las imagenes para el slider
     */
    public function run(): void
    {
        // Limpia la cache de roles y permisos para evitar problemas
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

      
        // Permisos para gestionar eventos y su agenda
        $eventPermissions = [
            'crear_eventos',   // Permite crear nuevos eventos
            'editar_eventos',  // Permite modificar la información de un evento
            'eliminar_eventos',// Permite borrar un evento
            'ver_eventos',     // Permite listar y visualizar detalles de eventos
            'gestionar_agenda',// Permite administrar la agenda asociada a un evento
            'ver_agenda',      // Permite consultar la agenda (horarios, ponentes, etc.)
        ];

        // Permisos para talleres y conferencias prácticas
        $workshopPermissions = [
            'crear_talleres',        // Crear nuevos talleres
            'editar_talleres',       // Editar la información de un taller
            'eliminar_talleres',     // Eliminar un taller existente
            'inscribirse_talleres',  // Permitir que un usuario se inscriba en un taller
            'ver_talleres',          // Ver listado y detalles de talleres
        ];

        // Permisos relacionados con los City Tours
        $cityTourPermissions = [
            'crear_city_tours',      // Crear recorridos turísticos
            'editar_city_tours',     // Editar información de un city tour
            'eliminar_city_tours',   // Eliminar un recorrido
            'inscribirse_city_tours' // Permitir que un usuario se registre en un tour
        ];

        // Permisos de administración de planes y precios
        $planPermissions = [
            'crear_planes',   // Crear planes de suscripción
            'editar_planes',  // Editar planes existentes
            'eliminar_planes',// Eliminar un plan
            'ver_planes',     // Ver listado de planes disponibles
            'comprar_planes', // Permitir a un usuario adquirir un plan
        ];

        // Permisos de gestión de noticias
        $newsPermissions = [
            'crear_noticias',   // Crear artículos/noticias en la plataforma
            'editar_noticias',  // Editar noticias publicadas
            'eliminar_noticias',// Eliminar noticias
            'ver_noticias',     // Ver noticias publicadas
        ];

        // Permisos para administración de usuarios y roles
        $userPermissions = [
            'gestionar_usuarios', // Crear, editar o eliminar usuarios
            'asignar_roles',      // Asignar o cambiar roles a un usuario
            'ver_roles',          // Consultar la lista de roles disponibles
        ];

        // Permisos de reseñas y comentarios
        $reviewPermissions = [
            'crear_reseñas',   // Permitir a un usuario dejar comentarios o calificaciones
            'ver_reseñas',     // Ver opiniones y calificaciones
            'moderar_reseñas', // Permitir a un admin validar o eliminar reseñas
        ];

        // Unir todos los permisos en un solo arreglo
        $allPermissions = array_merge(
            $eventPermissions,
            $workshopPermissions,
            $cityTourPermissions,
            $planPermissions,
            $newsPermissions,
            $userPermissions,
            $reviewPermissions
        );

        // Crear permisos en la base de datos
        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }
        
        $this->command->info('Permisos creados exitosamente!');
        $this->command->info('Total de permisos creados: ' . count($allPermissions));
    
    }
}
