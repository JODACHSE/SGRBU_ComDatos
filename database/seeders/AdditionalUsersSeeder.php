<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalUsersSeeder extends Seeder
{
    public function run(): void
    {
        $users = [];
        $firstNames = ['Carlos', 'Ana', 'Luis', 'María', 'José', 'Laura', 'Miguel', 'Sofia', 'David', 'Elena'];
        $lastNames = ['Gómez', 'Rodríguez', 'Martínez', 'Hernández', 'López', 'García', 'Pérez', 'González', 'Sánchez', 'Ramírez'];
        $academicStatuses = ['activo', 'activo', 'activo', 'activo', 'baja temporal', 'condicional', 'egresado'];

        // Crear 20 usuarios adicionales (15 estudiantes, 5 profesores)
        for ($i = 1; $i <= 20; $i++) {
            $isStudent = $i <= 15;
            $role = $isStudent ? 'estudiante' : 'profesor';

            // Generar student_code único empezando desde EST2024002
            $studentCode = $isStudent ? 'EST2024' . str_pad($i + 1, 3, '0', STR_PAD_LEFT) : null;

            $users[] = [
                'name' => $firstNames[array_rand($firstNames)],
                'lastname' => $lastNames[array_rand($lastNames)],
                'document_type_id' => rand(1, 3),
                'identification_number' => '1000' . str_pad($i + 4, 6, '0', STR_PAD_LEFT),
                'gender_id' => rand(1, 4),
                'emergency_contact_name' => 'Contacto Emergencia ' . $i,
                'emergency_contact_phone' => '3' . rand(10, 99) . rand(1000000, 9999999),
                'role' => $role,
                'campus_program_id' => $isStudent ? rand(1, 23) : null,
                'academic_status' => $isStudent ? $academicStatuses[array_rand($academicStatuses)] : 'activo',
                'student_code' => $studentCode,
                'is_active' => 1,
                'email' => 'user' . ($i + 4) . '@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'created_at' => now()->subDays(rand(30, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ];
        }

        DB::table('users')->insert($users);
    }
}
