<?php

namespace Database\Seeders;

use App\Models\Slot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlotSeeder extends Seeder
{
    public function run(): void
    {
        Slot::firstOrCreate([
            'slot' => '400',
        ]);
    }
}
