<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [];

        // Para cada usuario (1-4 que creaste), agregar 2-3 contactos
        for ($userId = 1; $userId <= 4; $userId++) {
            $contactCount = rand(2, 3);

            for ($i = 0; $i < $contactCount; $i++) {
                $contactTypeId = rand(1, 6);
                $contactValue = $this->generateContactValue($contactTypeId);

                $contacts[] = [
                    'user_id' => $userId,
                    'contact_type_id' => $contactTypeId,
                    'contact_value' => $contactValue,
                    'is_principal' => $i === 0 ? 1 : 0, // El primero es principal
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        DB::table('contacts')->insert($contacts);
    }

    private function generateContactValue($contactTypeId)
    {
        return match ($contactTypeId) {
            1, 2, 5 => '3' . rand(10, 99) . rand(100, 999) . rand(1000, 9999), // Teléfono
            3 => 'personal' . rand(1, 4) . '@example.com',
            4 => 'institucional' . rand(1, 4) . '@university.edu',
            6 => 'facebook.com/user' . rand(1000, 9999),
            default => 'contact' . rand(1000, 9999)
        };
    }
}
