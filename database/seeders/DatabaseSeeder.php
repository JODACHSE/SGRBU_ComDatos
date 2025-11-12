<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DocumentTypeSeeder::class,
            GenderSeeder::class,
            ContactTypeSeeder::class,
            ProgramTypeSeeder::class,
            ProgramSeeder::class,
            CampusSeeder::class,
            CampusProgramSeeder::class, // Nuevo
            ResourceTypeSeeder::class,
            ResourceStatusSeeder::class,
            ResourcesSeeder::class,
        ]);

        // Crear usuarios de prueba
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'lastname' => 'User',
            'document_type_id' => 1, // Cédula de Ciudadanía
            'gender_id' => 1, // Masculino
            'role' => 'admin',
            'identification_number' => '123456789',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '1234567890',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Staff',
            'lastname' => 'User',
            'document_type_id' => 1,
            'gender_id' => 2, // Femenino
            'role' => 'staff',
            'identification_number' => '987654321',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '0987654321',
            'email' => 'staff@example.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Estudiante',
            'lastname' => 'User',
            'document_type_id' => 1,
            'gender_id' => 1,
            'role' => 'estudiante',
            'identification_number' => '111222333',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '1112223333',
            'email' => 'estudiante@example.com',
            'campus_program_id' => 1, // Relacionado con campus_program
            'student_code' => 'EST2024001',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Teacher',
            'lastname' => 'User',
            'document_type_id' => 1,
            'gender_id' => 2,
            'role' => 'profesor',
            'identification_number' => '444555666',
            'emergency_contact_name' => 'Emergency Contact',
            'emergency_contact_phone' => '4445556666',
            'email' => 'profesor@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            ContactsSeeder::class, // Nuevo
        ]);
    }
}
