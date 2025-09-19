<?php

namespace Database\Seeders;

use App\Models\Participant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 399; $i++) {
            Participant::create([
                'uuid'              => Str::uuid(),
                'full_name'         => 'Participant ' . $i,
                'email'             => 'participant' . $i . '@example.com',
                'contact_number'    => '09' . str_pad($i, 9, '0', STR_PAD_LEFT), 
                'pet_name'          => 'Pet ' . $i,
                'pet_breed'         => fake()->randomElement(['Poodle', 'Labrador', 'Shih Tzu', 'Pug', 'Aspin']),
                'vaccination_card'  => 'uploads/vax-card.jpg', 
                'qr'                => 'qr/participant-' . $i . '.png' 
            ]);
        }
    }
}
