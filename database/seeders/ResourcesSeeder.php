<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesSeeder extends Seeder
{
    public function run(): void
    {
        $resources = [
            // Sports balls
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Balón de Fútbol',
                'resource_code' => 'DEP-FUT-001',
                'description' => 'Balón oficial tamaño 5 para fútbol',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Balón de Baloncesto',
                'resource_code' => 'DEP-BAS-001',
                'description' => 'Balón de baloncesto tamaño oficial',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Balón de Voleibol',
                'resource_code' => 'DEP-VOL-001',
                'description' => 'Balón de voleibol profesional',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 3,
                'name' => 'Balón de Fútbol Sala',
                'resource_code' => 'DEP-FUTS-001',
                'description' => 'Balón para fútbol sala',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Racket sports
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Raqueta de Tenis',
                'resource_code' => 'DEP-TEN-001',
                'description' => 'Raqueta de tenis profesional',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 3,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Raqueta de Bádminton',
                'resource_code' => 'DEP-BAD-001',
                'description' => 'Raqueta de bádminton con volantes',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Paletas de Ping Pong',
                'resource_code' => 'DEP-PING-001',
                'description' => 'Set de 2 paletas y pelotas de ping pong',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Athletic equipment
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Balón Medicinal 5kg',
                'resource_code' => 'DEP-MED-001',
                'description' => 'Balón medicinal para entrenamiento',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 1,
                'resource_status_id' => 1,
                'name' => 'Cuerda para Saltar',
                'resource_code' => 'DEP-CUER-001',
                'description' => 'Cuerda profesional para saltar',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 1,
                'resource_status_id' => 4,
                'name' => 'Vallas de Atletismo',
                'resource_code' => 'DEP-VALL-001',
                'description' => 'Set de 5 vallas para atletismo',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Musical instruments
            [
                'campus_id' => 1,
                'resource_type_id' => 2,
                'resource_status_id' => 1,
                'name' => 'Guitarra Acústica',
                'resource_code' => 'MUS-GUIT-001',
                'description' => 'Guitarra acústica para principiantes',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 3,
                'resource_type_id' => 2,
                'resource_status_id' => 1,
                'name' => 'Teclado Digital',
                'resource_code' => 'MUS-TECL-001',
                'description' => 'Teclado electrónico 61 teclas',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 2,
                'resource_status_id' => 2,
                'name' => 'Batería Electrónica',
                'resource_code' => 'MUS-BAT-001',
                'description' => 'Batería electrónica compacta',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 2,
                'resource_status_id' => 1,
                'name' => 'Flauta Dulce',
                'resource_code' => 'MUS-FLAU-001',
                'description' => 'Flauta dulce soprano',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 2,
                'resource_status_id' => 3,
                'name' => 'Micrófono Profesional',
                'resource_code' => 'MUS-MIC-001',
                'description' => 'Micrófono para voces e instrumentos',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Table games
            [
                'campus_id' => 1,
                'resource_type_id' => 3,
                'resource_status_id' => 1,
                'name' => 'Ajedrez',
                'resource_code' => 'JUE-AJED-001',
                'description' => 'Juego de ajedrez profesional',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 3,
                'resource_status_id' => 1,
                'name' => 'Cartas Españolas',
                'resource_code' => 'JUE-CART-001',
                'description' => 'Baraja de cartas españolas',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 3,
                'resource_type_id' => 3,
                'resource_status_id' => 1,
                'name' => 'Jenga',
                'resource_code' => 'JUE-JENG-001',
                'description' => 'Juego de torre de madera',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 1,
                'resource_type_id' => 3,
                'resource_status_id' => 1,
                'name' => 'Dominó',
                'resource_code' => 'JUE-DOM-001',
                'description' => 'Juego de dominó clásico',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'campus_id' => 2,
                'resource_type_id' => 3,
                'resource_status_id' => 1,
                'name' => 'Uno',
                'resource_code' => 'JUE-UNO-001',
                'description' => 'Juego de cartas Uno oficial',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('resources')->insert($resources);
    }
}
