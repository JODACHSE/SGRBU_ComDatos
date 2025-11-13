<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    public function run(): void
    {
        // Eliminar contactos existentes para evitar duplicados
        DB::table('contacts')->delete();

        $contacts = [];
        $usedCombinations = [];

        // Para cada usuario, agregar 2-3 contactos
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $contactCount = rand(2, 3);

            for ($i = 0; $i < $contactCount; $i++) {
                $contactTypeId = rand(1, 6);
                $contactValue = $this->generateContactValue($contactTypeId, $user->id);

                // Verificar que no exista esta combinación
                $key = $user->id . '-' . $contactTypeId . '-' . $contactValue;

                if (!in_array($key, $usedCombinations)) {
                    $usedCombinations[] = $key;

                    $contacts[] = [
                        'user_id' => $user->id,
                        'contact_type_id' => $contactTypeId,
                        'contact_value' => $contactValue,
                        'is_principal' => $i === 0 ? 1 : 0,
                        'is_active' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }
        }

        DB::table('contacts')->insert($contacts);
    }

    private function generateContactValue($contactTypeId, $userId)
    {
        return match ($contactTypeId) {
            1, 2, 5 => '3' . rand(10, 99) . rand(100, 999) . rand(1000, 9999), // Teléfono
            3 => 'personal' . $userId . rand(1, 999) . '@example.com',
            4 => 'institucional' . $userId . rand(1, 999) . '@university.edu',
            6 => 'facebook.com/user' . $userId . rand(1000, 9999),
            default => 'contact' . $userId . rand(1000, 9999)
        };
    }
}
